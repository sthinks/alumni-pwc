<?php

namespace App\Http\Controllers\Alumni;

use App\Events\ProfileUpdated;
use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Adding permission to user
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validate($this->rules());
        if($validated['name'] === 'directory' && $validated['value']) {
            if(!$user->current_work_company || !$user->current_work_role || !$user->legacy || !$user->pwc_quit_year || !$user->pwc_worked_office || !$user->pwc_worked_team_los || !$user->pwc_worked_team_sublos){
                return response()->json([
                    'Lütfen profilinizdeki tüm PwC Bilgilerini ve Profesyonel Tecrübe bilgilerini doldurunuz.'
                ]);
            }
        }
        $permission = Permission::whereSlug($validated['name'])->first();
        // if user wants to turn on permission
        if($validated['value']) {
            if(!$permission->users->contains($user)){
                $permission->users()->attach($user);
            }
        } else {
            $permission->users()->detach($user);
        }

        // update crm
        event(new ProfileUpdated($user));
        return response()->json([
            'status' => 'success',
            'data' => 'Profil izinleri başarıyla güncellenmiştir.',
        ]);
    }
    /**
     * Rules which applies to the request
     * @return string[]
     */
    private function rules(): array
    {
        return [
            'name' => 'required|exists:permissions,slug',
            'value' => 'required|integer'
        ];
    }
}
