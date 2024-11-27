<?php 

namespace App\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Staff;


class BCICChatService
{
   

    function getUnReadChat(){
        //SELECT * FROM `chat` WHERE  chat_type = 'staff' AND receiver_read = 'no'   ORDER BY `id` DESC;

        $chatdetails = DB::table('chat')
            ->select('id', 'to_id', 'from', 'to', 'receiver_read','chat_exact_time')
            ->where('chat_type', 'staff')
            ->where('receiver_read', 'no')
            ->orderBy('chat_exact_time', 'DESC')
            ->get(); // Get all chat data

            $groupedChats = $chatdetails->groupBy('from');
            return $groupedChats;
    }

    function getStafflist(){
        $staff = Staff::where('status', 1)
            ->orderByDesc('last_chat_datetime')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'mobile', 'job_types', 'team_of', 'site_id', 'site_id2', 'all_site_id', 'last_chat_datetime']);

            return $staff;
    }

    function chatdetails($staff_id = 0)
    {

        if ($staff_id > 0) {
            $results = DB::table('chat')->select('id','message','chat_exact_time','chat_type','to_id','from','to')
                ->where(function ($query) use ($staff_id) { // Pass $staff_id with 'use'
                    $query->where([['chat.from', $staff_id], ['chat_type', 'staff']])
                          ->orWhere([['chat.to_id', $staff_id], ['chat_type', 'admin']]);
                })
                ->where('chat_exact_time', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 5 DAY)'))
                ->orderBy('id', 'ASC')
                ->get();
        } else {
            $results = [];
        }

        return $results;
    }

        function sendNotification($message, $staff_id, $staffname = null) 
        {
            $adminId = (!empty(Auth::id())) ? Auth::id() : 0;

            $Arrdata = [
                'to' => $staffname,
                'to_id' => $staff_id,
                'from' => $adminId,
                'message' => $message,  // Assuming no_magic_quotes is a custom function
                'chat_type' => 'admin',
                'chat_exact_time'=>date('Y-m-d H:i:s'),
                'time' => time(),
                'sender_read' => 'yes',
                'receiver_read' => 'no',
                'sender_deleted' => 'no',
                'receiver_deleted' => 'no',
                'file' => '',
                'is_chat_job_id' => 0,
                'type_sms_info' => '2',
            ];
            
            $chatIn = DB::table('chat')->insert($Arrdata);

            $bool =  ($chatIn) ? true : false;

            return ['bool'=>$bool, 'details'=>$Arrdata];

        }
}


?>