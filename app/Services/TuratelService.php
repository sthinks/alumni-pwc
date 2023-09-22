<?php

namespace App\Services;

use App\Services\Contracts\SMSServiceContract;

class TuratelService implements SMSServiceContract
{
    /**
     * Sending sms
     *
     * @param $phone
     * @param $message
     *
     * @return bool
     */
    public function sendSMS($phone, $message): bool
    {
        $concat = 0;

        // If body length more than 160 characters,
        // concat value need to be 1
        if (strlen($message) > 160) {
            $concat = 1;
        }
        // crediantals
        $username = config('sms.turatel.username');
        $password = config('sms.turatel.password');
        $channelcode = config('sms.turatel.channelcode');
        $origin = config('sms.turatel.origin');
        $strXML = "<MainmsgBody>
                    <Command>0</Command>
                    <PlatformID>1</PlatformID>
                    <ChannelCode>${channelcode}</ChannelCode>
                    <UserName>${username}</UserName>
                    <PassWord>${password}</PassWord>
                    <Mesgbody>${message}</Mesgbody>
                    <Numbers>${phone}</Numbers>
                    <Type>1</Type>
                    <Option>1</Option>
                    <Concat>${concat}</Concat>
                    <Originator>${origin}</Originator>
                    <SDate></SDate>
                   </MainmsgBody>";
        $response = $this->HTTPPoster($strXML);
        if (auth()->user()) {
            $this->log(
                auth()->user(),
                config('activitylog.sms_logs.turatel'),
                [
                    'url' => config('sms.turatel.endpoint'),
                    'body' => $strXML,
                ],
                $response
            );
        }
        return strlen($response) > 4;
    }

    /**
     * @param $prmSendData
     *
     * @return bool|string
     */
    private function HTTPPoster($prmSendData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('sms.turatel.endpoint'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $prmSendData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * Log request and response
     *
     * @param mixed $user
     * @param string $type
     * @param array $request
     * @param $response
     */
    private function log($user, string $type, array $request, $response)
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
