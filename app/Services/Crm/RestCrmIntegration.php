<?php

namespace App\Services\Crm;

use App\Helpers\StrHelper;
use App\Permission;
use App\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class RestCrmIntegration extends RestClient
{
    /**
     * Updating user in crm
     *
     * @param mixed $user
     */
    public function updateUser($user)
    {
        $endpoint = config('crm-client.update.endpoint');
        $params = [
            'StaffId' => $user->staff_id,
            'FirstName' => $user->getFirstName(),
            'LastName' => $user->getSurname(),
            'FullName' => $user->name,
            'ikinciSoyad' => $user->second_surname,
            'DogumTarihi' => optional($user->birthdate)->format('Y-m-d'),
            'PersonelEmailAddress' => $user->email,
            'BusinessEmailAddress' => $user->second_mail,
            'MobilePhone' => $user->phone,
            'PersonalHomeAddress' => $user->home_address,
            'linkedInURL' => $user->linkedin,
            'Hobbies' => $user->hobbies()->get()->implode('hobby_title', ','),
            'University' => $user->university,
            'LegalEntity' => optional($user->pwcLegacy()->first())->name,
            'StartDateOfPwC' => optional($user->pwc_join_year)->format('Y-m-d'),
            'LeaveDateOfPwC' => optional($user->pwc_quit_year)->format('Y-m-d'),
            'Office' => optional($user->pwcWorkedOffice()->first())->name,
            'LoS' => optional($user->pwcWorkedTeamLos()->first())->name,
            'SubLoS' => optional($user->pwcWorkedTeamSubLos()->first())->name,
            'CompanyName' => $user->current_work_company,
            'Role' => $user->current_work_role,
            'Skills' => collect(Arr::flatten($user->skills()->get(['name'])->makeHidden('pivot')->toArray()))->join(','),
            'EmailMemberShipList' => [
                [
                    'EmailMembership' => '5a507808-f03f-e911-9585-02bf0a36f0c4',
                    'isSubscribed' => optional(Permission::where('crm', '5a507808-f03f-e911-9585-02bf0a36f0c4')->first())->users->contains($user->id),
                ],
                [
                    'EmailMembership' => 'ef1b1703-df12-e711-811a-02bf0a36f0c4',
                    'isSubscribed' => optional(Permission::where('crm', 'ef1b1703-df12-e711-811a-02bf0a36f0c4')->first())->users->contains($user->id),
                ],
                [
                    'EmailMembership' => 'ed1b1703-df12-e711-811a-02bf0a36f0c4',
                    'isSubscribed' => optional(Permission::where('crm', 'ed1b1703-df12-e711-811a-02bf0a36f0c4')->first())->users->contains($user->id),
                ],
                [
                    'EmailMembership' => 'eb1b1703-df12-e711-811a-02bf0a36f0c4',
                    'isSubscribed' => optional(Permission::where('crm', 'eb1b1703-df12-e711-811a-02bf0a36f0c4')->first())->users->contains($user->id),
                ],
                [
                    'EmailMembership' => 'e91b1703-df12-e711-811a-02bf0a36f0c4',
                    'isSubscribed' => optional(Permission::where('crm', 'e91b1703-df12-e711-811a-02bf0a36f0c4')->first())->users->contains($user->id),
                ],
                [
                    'EmailMembership' => 'e71b1703-df12-e711-811a-02bf0a36f0c4',
                    'isSubscribed' => optional(Permission::where('crm', 'e71b1703-df12-e711-811a-02bf0a36f0c4')->first())->users->contains($user->id),
                ],
            ],
        ];
        // empty strings should be converted to null value
        $params = array_map(static function ($val) {
            if (is_string($val)) {
                return StrHelper::checkStringForEmpty($val);
            }
            return $val;
        }, $params);
        try {
            $response = $this->send($endpoint, $params);
            $this->log(
                $user,
                config('activitylog.crm_logs.update'),
                [
                    'url' => $endpoint,
                    'body' => json_encode($params, JSON_UNESCAPED_UNICODE),
                ],
                $response->json()
            );
        } catch (Exception $e) {
            Log::warning($e);
        }
    }

    /**
     * Log request and response
     *
     * @param User $user
     * @param string $type
     * @param array $request
     * @param $response
     */
    private function log(User $user, string $type, array $request, $response)
    {
        activity($type)
            ->performedOn($user)
            ->withProperties([
                'request' => $request,
                'response' => $response,
            ])
            ->log($type);
    }
}
