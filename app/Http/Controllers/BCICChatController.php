<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Support\Collection;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\Staff;


use App\Facades\BCICChat;

  


class BCICChatController extends MasterController
{

    public function __construct()
    {
            $this->middleware('auth');
    }

     function bcic_chat() {
        
          return view('chat.index');

     }


        function getStaffChatlist(Request $request) 
        {
             if ($request->expectsJson()) {
                // Get unread chat messages
                $chatdetails = BCICChat::getUnReadChat();
        
                // Retrieve staff data
                $staffData = BCICChat::getStafflist(); 
        
                // Prepare final staff data
                $finalStaffData = [];
        
                foreach ($staffData as $key => $staffdetails) {
                    // Get the unread chat details for each staff member
                    $unreadChats = $chatdetails->get($staffdetails->id); // Access chats grouped by 'from'
        
                    // If unread chats exist for this staff, count them
                    $staffdetails['totalReco'] = $unreadChats ? count($unreadChats) : 0;
        
                    // Initialize the 'lastdate' to null
                    $staffdetails['lastdate'] = null;
        
                    // Retrieve the last chat date if available
                    if ($unreadChats && $unreadChats->isNotEmpty()) {
                        $lastChat = $unreadChats->first()->chat_exact_time;  // Get the last chat time
                        $staffdetails['lastdate'] = ($lastChat); // Format the date
                    }
        
                    // Add the staff data to the final array
                    $finalStaffData[] = $staffdetails;
                }
        
                // dd($finalStaffData);

                // Return the final staff data
                return response()->json($finalStaffData, 200);
            }
        
            // If not a valid request, return an error response
            return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
        }

        function getchatDetails(Request $request) {
            if ($request->expectsJson()) {
                $staff_id = $request->input('staff_id', 0);
                $results = BCICChat::chatdetails($staff_id);
                return response()->json(['success' => true, 'data' => $results], 200);
            }
        
            return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
        }

        function sendChatMessage(Request $request) {

            // dd($request->expectsJson());
             
            if ($request->expectsJson()) {
               
                    $staff_id = $request->input('staff_id', 0);
                    $message = trim($request->input('message', ''));
                    $staff_name = $request->input('staff_name',null);

                if(empty($message)){
                    return response()->json(['success' => false, 'message' => 'Please enter message'], 200);
                }

                if(!empty($message)) {
                     $isMessage = BCICChat::sendNotification($message , $staff_id, $staff_name);
                     return response()->json(['success' => $isMessage['bool'],'message' => 'Notification message has been sent successfully' ,  'data' => $isMessage['details']], 200);
                }
            }
            return response()->json(['success' => false, 'message' => 'Not a valid request'], 200);
        }

}