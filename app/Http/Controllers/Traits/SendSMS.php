<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait SendSMS
{
    protected $apiKey = '5cV8wu8CUMJ5XEMCmNDEUwWTJHrAC7cxVsNtNr84kTW5f5AyWQBxLbGW6uwkZyTe7V6Vc5CEffHVGskSJhd6z6B5HgsKXZsnaKSu';
    protected $apiUrl = 'https://dialpad.com/api/v2/sms';

    public function send_sms($mobile, $message, $type = 0, $isid = 0)
    {
        /*
           $type = >  1=>Quote,2=>Jobs,3=>Staff,4=>App,5=>Admin
        */

       // dd($mobile); 

        $destination = $mobile;
        $text = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

        // Remove leading 0 if present
        if (substr($destination, 0, 1) == '0') {
            $destination = substr($destination, 1);
        }

        $mobilenumber = strlen($destination);

        if ($mobilenumber == 9) {
            $adminid = Session::get('id', 0);
            $adminname = Session::get('name', 'Automated');

            // Prepare POST data
            $postData = [
                'chatMessage' => $text,
                'sendTo' => '+61485901939', //'+61' . str_replace(" ", "", trim($destination)),
                'adminId' => $adminid,
                'adminname' => $adminname,
                'istype' => $type,
                'is_id' => $isid,
            ];

           // dd($postData);

            // $resp = $this->sendDailPadSMS($postData);
            // return $resp;

            return 1;
        } else {
            return 0;
        }
    }

    private function sendDailPadSMS(array $data)
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl . '?apikey=' . urlencode($this->apiKey), [
                'infer_country_code' => false,
                'text' => $data['chatMessage'],
                'to_numbers' => [$data['sendTo']],
                'from_number' => '+61452229882',
            ]);

            $responseData = $response->json();
            
            

            if (isset($responseData['id']) && !empty($responseData['id'])) {
                $datadetails = [
                    'adminId' => $data['adminId'],
                    'adminname' => $data['adminname'],
                    'to' => $data['sendTo'],
                    'from' => '+61452229882',
                    'body' => $data['chatMessage'],
                    'sms_setting_type' => 4,
                    'baseUrl' => serialize($responseData),
                    'flag' => 0,
                    'istype' => $data['istype'],
                    'is_id' => $data['is_id'],
                ];

                $this->saveSmsInsertion($datadetails);
               
                return 1;
            } else {
               // Log::error('Dialpad SMS API response error', $responseData);
                return 0;
            }

        } catch (\Exception $e) {
           // Log::error('Dialpad SMS API request failed', ['error' => $e->getMessage()]);
            return 0;
        }
    }

    public function saveSmsInsertion($datadetails)
    {
       //  dd($datadetails);
        $sms_setting_type = $datadetails['sms_setting_type'] ?? 3;
        $baseUrl = $datadetails['baseUrl'] ?? '';
        $smstype = $this->getsmsType($datadetails['istype'] ?? 0);
        $type = (!empty($datadetails['type']) && ($datadetails['type'] === 'end_user')) ? 'end_user' : 'admin';
        $is_sms_type = $datadetails['istype'] ?? '';
        $is_id = $datadetails['is_id'] ?? 0;
        
        $getData = [
            'admin_id' => $datadetails['adminId'] ?? 0,
            'read_by' => 0,
            'to_num' => '0' . substr($datadetails['to'], 3),
            'to_num_code' => substr($datadetails['to'], 0, 3),
            'from_num' => '0' . substr($datadetails['from'], 3),
            'from_num_code' => substr($datadetails['from'], 0, 3),
            'message' => $datadetails['body'],
            'account_id' => '',
            'msg_id' => '',
            'sms_setting_type' => $sms_setting_type,
            'incoming_msg_type' => 0,
            'is_sms_type' => $is_sms_type,
            'is_id' => $is_id,
            'date_sent' => Carbon::now()->toDateString(),
            'date_time' => Carbon::now(),
            'only_date' => Carbon::now()->toDateString(),
            'only_time' => Carbon::now()->format('H:i:s a'),
            'sender' => 1,
            'receiver' => 1,
            'type' => $type,
            'status' => 0,
            'is_deleted' => 1,
            'apiVersion' => 'none',
            'media' => 'none',
            'uri' => 'none',
            'baseUrl' => $baseUrl,
        ];

        // dd($getData); // Uncomment for debugging
         DB::table('bcic_sms')->insert($getData);
          return 1;
    }

    function getsmsType($id) {
        $smsName = ['0' => 'Other', '1' => 'Quote', '2' => 'Job', '3' => 'Staff', '4' => 'HR'];
        return $smsName[$id] ?? '';
    }
}
