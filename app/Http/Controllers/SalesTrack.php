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


use App\Mail\ViewQuoteMmail;

use App\Models\QuoteFor;
use App\Models\JobType;
use App\Models\User;
use App\Models\TempQuote;
use App\Models\TempDetails;
use App\Models\QuoteNew;
use App\Models\TaskManager;
use App\Models\SalesTaskTrack;
use App\Models\QuoteDetails;
use App\Models\JobDetail;
use App\Models\Sites;
use App\Models\TruckList;
use App\Models\C3cxUser;
use App\Models\QuoteEmailNote;
use App\Models\SaveQuoteQuestion;

//use App\Traits\SendSMS;



class SalesTrack extends MasterController
{
    
        public function __construct()
        {
                $this->middleware('auth');
        }
     

        public function getAllTaskInfo(Request $request)
        {
            // dd($request->all());  
              
            $adminid = (!empty($request->input('adminid'))) ? $request->input('adminid') : 'all';  
            $taskType = (!empty($request->input('taskType'))) ? $request->input('taskType') : '3';  
            $search_type = (!empty($request->input('search_type'))) ? $request->input('search_type') : '';  
            $search_value = (!empty($request->input('search_value'))) ? $request->input('search_value') : '';  
            $isLate = (!empty($request->input('isLate'))) ? $request->input('isLate') : '';  
            $priority = (!empty($request->input('priority'))) ? $request->input('priority') : 0;   

            $fromtoday = Carbon::now()->subMinutes(20)->format('Y-m-d H:i:s');
            $lasttoday = Carbon::now()->addMinutes(20)->format('Y-m-d H:i:s');
            
            $overDue1day = Carbon::yesterday()->format('Y-m-d');
            $upcomming1day = Carbon::tomorrow()->format('Y-m-d');
            
            $currentData = Carbon::now()->format('Y-m-d H:i:s');

            $getTaskType = [];
            $gettotalRec = [];
            $getAllDATA = [];
            $taskRecords = [];

            if ($taskType == 'all') {
                $getAllDATA = array_merge(
                    $this->salesTask($adminid, $search_type, $search_value),
                    $this->HRTask($adminid, $search_type, $search_value),
                    $this->reviewTask($adminid, $search_type, $search_value),
                    $this->CustomTask($adminid, $search_type, $search_value),
                    $this->reCleanTask($adminid, $search_type, $search_value),
                    $this->unAssignTask($adminid, $search_type, $search_value),
                    $this->otdTask($adminid, $search_type, $search_value, $isLate, $priority),
                    $this->cleanerQualityTask($adminid, $search_type, $search_value),
                    $this->callCareTask($adminid, $search_type, $search_value),
                    $this->complaintTask($adminid, $search_type, $search_value),
                    $this->voucherData($adminid, $search_type, $search_value)
                );

            } else {
                $taskFunctions = $this->getFunctionName();

                if (array_key_exists($taskType, $taskFunctions)) {
                    $function = $taskFunctions[$taskType];
                    $getAllDATA = $this->$function($adminid, $search_type, $search_value, $isLate, $priority);
                }
            }

            
            // echo '<pre>'; print_r($getAllDATA); die;

             $getsite = getsite();

           // dd($getAllDATA); 
           $allFinalData = [];
            if(!empty($getAllDATA)) 
            {
                foreach ($getAllDATA as $key => $val1) 
                {
                   if(!empty($val1)){    
                    
                       //Log::info('info' ,  $val1);
                      //$fallow_date = Carbon::parse($val1['fallow_date']);
                      $fallowDate = (!empty($val1['fallow_date']) && $val1['fallow_date'] != '0000-00-00 00:00:00') 
                      ? Carbon::parse($val1['fallow_date']) 
                      : Carbon::now(); // Use Carbon::now() instead of date() to keep it consistent

                        $pageid = (!empty($val1['pageid'])) ? $val1['pageid'] : 0;
                        $adminName1 = (!empty($val1['task_manage_id'])) ? get_rs_value('admin','name', $val1['task_manage_id']) : 'NA';
                        
                        $val1['task_admin_name'] = (!empty($adminName1)) ? $adminName1 : '0';
                        $fallowTiime = (!empty($val1['fallow_time'])) ? $val1['fallow_time'] : ''; 
                        $val1['fallow_date_time'] = $fallowDate->format('dS M') . ' ' . $fallowTiime;
        
                        if(in_array($pageid , [1])) {
                            $val1['site_name'] = (!empty($val1['site_id'])) ? $getsite[$val1['site_id']]['abv'] : '';
                        }else if(in_array($pageid , [3,13])) {
                            $val1['site_name'] = (!empty($val1['site_id'])) ? $getsite[$val1['site_id']]['name'] : '';
                        }else{
                            $val1['site_name'] = '';
                        }
                        
        
                        if ($fallowDate->format('Y-m-d') <= $overDue1day) {
                            $getTaskType[1][] = $val1;
                            $gettotalRec[$pageid][1][] = $val1;
                            
                            $taskRecords[$val1['task_manage_id']][1][] = $val1;

                        } elseif ($fallowDate->format('Y-m-d') == Carbon::today()->format('Y-m-d') && $fallowDate->format('Y-m-d H:i:s') <= $fromtoday) {
                            $getTaskType[2][] = $val1;
                            $gettotalRec[$pageid][2][] = $val1;
                            $taskRecords[$val1['task_manage_id']][2][] = $val1;
                        } elseif ($fallowDate->format('Y-m-d H:i:s') >= $fromtoday && $fallowDate->format('Y-m-d H:i:s') <= $lasttoday) {
                            $getTaskType[3][] = $val1;
                            $gettotalRec[$pageid][3][] = $val1;
                            $taskRecords[$val1['task_manage_id']][3][] = $val1;
                        } elseif ($fallowDate->format('Y-m-d') == Carbon::today()->format('Y-m-d') && $fallowDate->format('Y-m-d H:i:s') <= Carbon::today()->endOfDay()->format('Y-m-d H:i:s')) {
                            $getTaskType[4][] = $val1;
                            $gettotalRec[$pageid][4][] = $val1;
                            $taskRecords[$val1['task_manage_id']][4][] = $val1;
                        } elseif ($fallowDate->format('Y-m-d') >= $upcomming1day) {
                            $getTaskType[5][] = $val1;
                            $gettotalRec[$pageid][5][] = $val1;
                            $taskRecords[$val1['task_manage_id']][5][] = $val1;
                        }
        
                        $allFinalData[] = $val1;
                    }
                }
            }

            return response()->json([
                'alldata' => $getTaskType,
                'totaldata' => $gettotalRec,
                'totalRecod' => $allFinalData,
                'taskRecords' => $taskRecords
            ]);
        }

        function getTrackNotes(Request $request) {

            $salesid = (!empty($request->input('salesid'))) ? $request->input('salesid') : 0;  
            $tasktype = (!empty($request->input('tasktype'))) ? $request->input('tasktype') : '1';  
            $box_type = (!empty($request->input('box_type'))) ? $request->input('box_type') : '1';  
            $getData =   $this->get_app_activity($salesid,$tasktype,$box_type);
            return response()->json(['notes'=>$getData]);
        }

            function getNextschedule(Request $request) {
               $follow_data1 = dd_value(119);

                $daytime = [];
                foreach($follow_data1 as $keyid=>$followvalue) {  
                    $ct = date('H:i');
                    if($ct < $followvalue) {
                        $daytime[$keyid] = 'Today '.$followvalue;
                    }else{
                        $daytime[$keyid] = 'Tomo '.$followvalue;
                    }
                }
                return response()->json($daytime);  
            }

            function callNextShdl(Request $request) 
            {
                    //  dd($request->all());
                    $salesid = $request->input('salesid');
                    $pageid = $request->input('pageid');
                    $keyid = $request->input('schdleid');
                    $shdltype = $request->input('shdltype');

                    $calldate = $request->input('calldate' , Carbon::now()->format('Y-m-d'));
                    $callTime = $request->input('callTime' , Carbon::now()->format('H:00:H:30'));
                    $staff_name = session('name');

                    if($shdltype == 1) {

                                $follow_data = dd_value(119); // Assuming dd_value() is a custom method you have

                                // Current time
                                $ct = Carbon::now()->format('H:i');

                                // Determine the date
                                if ($ct < $follow_data[$keyid]) {
                                    $date = Carbon::now()->format('Y-m-d');
                                } else {
                                    $date = Carbon::now()->addDay()->format('Y-m-d');
                                }

                                // Get time from follow data
                                $gettime = $follow_data[$keyid];

                                // Define schedule time
                                $schedule_time = Carbon::createFromFormat('H:i', $gettime)->addMinutes(30)->format('H:i');
                                $schedule_time_range = $gettime . '-' . $schedule_time;
                                

                                // Heading for notification
                                $heading = "Call Auto Re-Schedule by $staff_name time $date ($schedule_time_range)";

                                // Next action
                                //$next_action = 'Follow up auto';

                                // Calculate follow-up date
                                $timedate = explode('-', $schedule_time);
                                $time = Carbon::createFromFormat('H:i', $timedate[0])->addMinutes(15)->format('H:i:s');
                                $fallow_date = "$date-$time";

                                // Update the record
                                SalesTaskTrack::where('id', $salesid)->update([
                                    'fallow_date' => $fallow_date,
                                    'fallow_created_date' => $date,
                                    'fallow_time' => $schedule_time_range,
                                ]);

                                // Define response type and schedule time date
                                $response_type = 9;
                               // $schedule_time_date = $schedule_time_range;

                    }else if($shdltype == 2) {
                        $timedate = explode('-',$callTime);
                        $time = Carbon::createFromFormat('H:i', $timedate[0])->addMinutes(15)->format('H:i:s');
                        $fallow_date = "$calldate-$time";

                        SalesTaskTrack::where('id', $salesid)->update([
                            'fallow_date' => $fallow_date,
                            'fallow_created_date' => $calldate,
                            'fallow_time' => $callTime,
                        ]);

                        $response_type = 10;
			            // $heading = ' Call Schedule at'.$fallow_date;
                         $heading = "Call Schedule by $staff_name time $calldate ($callTime)";
                    }

                    $this->addNoteswithTrackManager($salesid ,  $response_type , $heading , $pageid);
                    $getsalesInfo = $this->getTrackDataInfo($salesid);

                     return response()->json(['message'=>$heading,'taskdata'=>$getsalesInfo]);
            }
            


            function getLoastddData(Request $request) {

                $typeid = $request->input('typeid');
                $ddValue = dd_value($typeid);
                return response()->json($ddValue);  
            }

            function ansLeftButton(Request $request) 
            {
                
                $salesid = $request->input('salesid', 0);
                $fname = $request->input('fieldname', '');
                $pageid = $request->input('pageid', 0);
                

                $getsales_follow = DB::table('sales_task_track')
                        ->select('id', 'quote_id', 'job_id', 'app_id', 'track_type', 'fallow_created_date', 'fallow_date', 'fallow_time', 'task_manager_id')
                        ->find($salesid);
                
                // Default values
                $task_result = '';
                $ans_date = '0000-00-00 00:00:00';
                $left_sms_date = '0000-00-00 00:00:00';
                $stage = 0;
                $response_type = 0;
                $calltype = 1;
                
                if($pageid == 4) {

                    if ($fname === 'ans_date') {

                        $callfield = 'first_email';
                        $task_result = 'First Called';
                        $review_status = 2;
                        $date = date('Y-m-d' , strtotime("+2 days"));

                    }elseif ($fname === 'sec_ans_date') {

                        $callfield = 'second_email';
                        $task_result = 'Second Called';
                        $review_status = 4;
                        $date = date('Y-m-d' , strtotime("+3 days"));

                    }elseif ($fname === 'third_ans_date') {

                        $callfield = 'threed_email';
                        $task_result = 'Third Called';
                        $review_status = 6;
                        $date = date('Y-m-d' , strtotime("-3 hours")); 

                    }

                    $ans_date = Carbon::now()->format('Y-m-d H:i:s');
                    $left_sms_date = '0000-00-00 00:00:00';
                    $response_type = 1;
                    $stage = 1;

                    $update_data2 = [
                        'ans_date' => $ans_date,
                        'left_sms_date' => $left_sms_date,
                         $callfield => Carbon::now()->format('Y-m-d H:i:s'),
                        'stages' => $stage,
                    ];

                    DB::table('sales_task_track')
                    ->where('id', $salesid)
                    ->update($update_data2);
                    
                    $jobid = $getsales_follow->job_id;
                    $quote_id = $getsales_follow->quote_id;

                    DB::table('quote_new')
                    ->where('id', $quote_id)
                    ->update(['review_status'=>$review_status]);

                    
                     $this->addReviewNotes(0, $task_result, $task_result, '', $jobid );


                        $getTime = now()->format('H:i:s');
                        $scheduleTime = $getTime . '-' . now()->addMinutes(30)->format('H:i');
                        $heading1 = $task_result." Auto Re-Schedule  on " . $date . " (" . $scheduleTime . ")";

                        $nextAction = 'Follow up auto';

                        $time = Carbon::createFromFormat('H:i:s', explode('-', $scheduleTime)[0])->addMinutes(15)->format('H:i:s');
                        $fallowDate = $date . '-' . $time;

                        $this->addReviewNotes(0, $heading1, $heading1, '', $jobid );

                            SalesTaskTrack::where('id', $salesid)
                            ->update([
                                'fallow_date' => $fallowDate,
                                'fallow_created_date' => $date,
                                'fallow_time' => $scheduleTime,
                            ]);

                     

                }

                    if ($fname === 'ans_date') {
                        $task_result = 'Answered';
                        $ans_date = Carbon::now()->format('Y-m-d H:i:s');
                        $left_sms_date = '0000-00-00 00:00:00';
                        $stage = 1;
                        $response_type = 1;
                    } elseif ($fname === 'left_sms_date') {
                        $task_result = 'Left Message';
                        $left_sms_date = Carbon::now()->format('Y-m-d H:i:s');
                        $ans_date = '0000-00-00 00:00:00';
                        $stage = 2;
                        $response_type = 2;
                        $callType = 1;
                    } 


                    $update_data = [
                        'ans_date' => $ans_date,
                        'left_sms_date' => $left_sms_date,
                        'stages' => $stage,
                    ];

                    

                    DB::table('sales_task_track')
                    ->where('id', $salesid)
                    ->update($update_data);
                    $comments = $task_result;

                 $this->addNoteswithTrackManager($salesid ,  $response_type , $comments , $pageid, $getsales_follow);
                 $getsalesInfo = $this->getTrackDataInfo($salesid);
                 return response()->json(['message'=>$task_result,'taskdata'=>$getsalesInfo]);
            }

            function getPopupDetails(Request $request) 
            {
 
                 $pageid = $request->input('pageid');
                 $salesid = $request->input('salesid');

                 $taskFunctions = $this->getFunctionName();

                if (array_key_exists($pageid, $taskFunctions)) {
                    $function = $taskFunctions[$pageid];
                    $getAllDATA = $this->$function('all', '', '', $salesid);
                }
                    $getsite = getsite();
                    $val1 = $getAllDATA[0];
                    $fallowDate = Carbon::parse($val1['fallow_date']);
                    $pageid = $val1['pageid'];
                    $adminName1 = get_rs_value('admin','name',$val1['task_manage_id']);

                    $val1['task_admin_name'] = (!empty($adminName1)) ? $adminName1 : '0';
                    $val1['fallow_date_time']  = date('dS M ', strtotime($val1['fallow_date'])) .' '.$val1['fallow_time'];

                    if(in_array($pageid , [1])) {
                    $val1['site_name'] = (!empty($val1['site_id'])) ? $getsite[$val1['site_id']]['abv'] : '';
                    }else if(in_array($pageid , [3,13])) {
                    $val1['site_name'] = (!empty($val1['site_id'])) ? $getsite[$val1['site_id']]['name'] : '';
                    }else{
                     $val1['site_name'] = '';
                    }

                return response()->json($val1);
                  
            }

            function getsalesSMS(Request $request) {

                 //dd($request->all());
                $quote_id = $request->input('quote_id');
                $salesid = $request->input('salesid');
                $sms_type_id = $request->input('sms_type_id');
                $issmsEmail = $request->input('type');
               
                $returnData = $this->getEmailSMSTemplate($quote_id, $salesid, $sms_type_id, $issmsEmail);

                $comment_msg = $returnData['comment_msg'];
                $subject = $returnData['subject'];
                $quotedata = $returnData['quotedata'];

                $response_type = ($sms_type_id-1);
                $commentshow = 'SMS '.$sms_type_id.' Copied';
                $this->addNoteswithTrackManager($salesid ,  $response_type , $commentshow , 1);

               // $this->addNoteswithTrackManager($salesid ,  $response_type , $comments , $pageid);

                return response()->json(['message_type'=>$sms_type_id , 'message'=>$comment_msg]);
            }

            function getsalesEmail(Request $request) {
      
                 $template_id = $request->input('template_id');
                 $quote_id = $request->input('quote_id');
                 $salesid = $request->input('salesid');
                 $issmsEmail = $request->input('type');
                 $text = $request->input('text');

                 
                $returnData = $this->getEmailSMSTemplate($quote_id, $salesid, $template_id, $issmsEmail);
               // dd($returnData);
                $comment_msg = $this->setEmailTpl($returnData['comment_msg']);  
                $subject = $returnData['subject'];
                $quotedata = $returnData['quotedata'];
                $sendfrom = $returnData['booking_email'];

                $newSubject = 'Q#'.$quotedata['id'] .'- '.$subject;
                

                Mail::html($comment_msg, function ($message) use ($quotedata, $newSubject, $sendfrom) {
                   
                    $message->to('pankaj.business2sell@gmail.com', $quotedata['name'])
                            ->subject($newSubject)
                            ->from($sendfrom);
                });

                $response_type = ($template_id + 5);
                $commentshow = 'Send '.$text.' email on pankaj.business2sell@gmail.com';
                $this->addNoteswithTrackManager($salesid ,  $response_type , $commentshow , 1);
                  
                 return response()->json(['message_type'=>$template_id , 'message'=>$commentshow, 'subject'=>$subject,'quotedata'=>$quotedata]);

            }

            function reviewDone(Request $request) {
                $salesid = $request->input('id');

                SalesTaskTrack::where('id', $salesid)
                ->update([
                    'task_status' => 0,
                    'task_status_date' => Carbon::now()->format('Y-m-d H:i:s')
                ]);

                return response()->json(['message'=>'Review Call Done']); 
            }

            function sendFeedbackEmail(Request $request) {

              //  dd($request->all());
                $type = $request->input('type');
                $jobid = $request->input('job_id');
                $salesid = $request->input('salesid');
 
                // Fetch data using Eloquent ORM
                        $data = DB::table('quote_new')
                        ->select('id', 'site_id', 'booking_id', 'booking_date', 'name', 'email')
                        ->where('booking_id', $jobid)
                        ->first();

                    $qid = $data->id;

                    $feedbackurl = $this->getFeedbackUrl($jobid);

                    $flag = 1;
                    
                    $name = $data->name;
                    if ($type == 1) {
                        DB::table('sales_task_track')
                            ->where('id', $salesid)
                            ->update(['feedback_email' => Carbon::now()->format('Y-m-d h:i:s')]);

                        DB::table('quote_new')
                            ->where('id', $qid)
                            ->update(['review_status' => 6]);

                        $subject = 'J#' . $jobid . ' Tell us what you think! Feedback on our service ';
                        $tplFile = 'feedback_tpl';
                        $voucher_number = '';

                        $messageText = 'FeedBack Email';

                    } elseif ($type == 2) {
                        DB::table('sales_task_track')
                            ->where('id', $salesid)
                            ->update(['voucher_email' => Carbon::now()->format('Y-m-d h:i:s')]);

                        DB::table('quote_new')
                            ->where('id', $qid)
                            ->update(['review_status' => 8]);

                        $subject = 'J#' . $jobid . ' Thank You for Choosing Our Services! Enjoy a Gift from Us: Cleaning Voucher Inside ';
                        $tplFile = 'review_tpl';
                        $job_amount = 50;
                        $voucher_number = $this->genRandomString();
                        $comment = 'Review Comment';
                        $voucherData = $jobid . '|' . $job_amount . '|' . $comment . '|1|' . $voucher_number;
                        $this->addgiftvouch($voucherData);

                        $messageText = 'Voucher Email';
                    }

                    $getEmailTpl = $this->getReviewEmailTpl($type, $voucher_number);
                    $templatePath = 'email_tpl.' . $tplFile;

                    //echo $templatePath; die;

                    $str1_data = view($templatePath,['name'=> $name , 'getEmailTpl'=>$getEmailTpl,'flag'=>1,'feedbackurl'=>$feedbackurl])->render();


                    
                    $emailOut = 'pankaj.business2sell@gmail.com'; //$data->email;
                    $sendfrom = "reviews@bcic.com.au";

                    $comment_msg = $this->setEmailTpl($str1_data);  

                    Mail::html($comment_msg, function ($message) use ($subject, $sendfrom) {
                   
                        $message->to('pankaj.business2sell@gmail.com', 'Pankaj')
                                ->subject($subject)
                                ->from($sendfrom);
                    });

                   $this->addJobEmails($jobid, $subject, $str1_data, $data->email);
                   $getsalesInfo = $this->getTrackDataInfo($salesid);
                   return response()->json(['message'=>$messageText,'taskdata'=>$getsalesInfo]);
            }

            function salesStatuUpdate(Request $request) 
            {

                $statusVal = $request->input('value');
                $salesid = $request->input('salesid');

                $statusdd = dd_value(135);

               // dd($statusdd);

                $textStatus = $statusdd[$statusVal];

                

                $heading = ' Voucher Task status moved to '.$statusdd[$statusVal];

                SalesTaskTrack::where('id', $salesid)->update([
                    'is_task_status' => $statusVal
                ]);
                return response()->json($textStatus);
            }

            function getHrSMS(Request $request) {
               
                if ($request->expectsJson()) {
                  $cleaningtype = $request->input('cleaningtype');
                  $removaltype = $request->input('removaltype');
                  $jobtypeid = $request->input('jobtypeid');
                  $typeid = $request->input('typeid');
                  $name = $request->input('name');
                  $adminname = session('name');

                   if($jobtypeid == 1) {
                       $sms_type_id = $cleaningtype;
                   }else{
                       $sms_type_id = $removaltype;
                   }
               
                   $emaildata = DB::table('tpl_application')->select('message','subject')->where('id',$sms_type_id)->first();

                    if(!empty($emaildata)) {
                        $content = str_replace(
                            ['$cname', '$adminname','$lb'],
                            [$name, $adminname,''],
                            $emaildata->message
                        );
                        $subject = $emaildata->subject;
                    }else{
                        $content = '';
                        $subject = '';
                    }
                    return response()->json(['comtent'=>$content,'subject'=>$subject,'typeid'=>$typeid]);
                }else {
                    return response()->json('Not valid request');
                }

            }

            function sendHrSMS(Request $request) {

                if($request->expectsJson()) 
                {
                    
                    $subject = $request->input('subject');
                    $phone = $request->input('phone');
                    $message = $request->input('message');
                    $app_id = $request->input('app_id');
                    $salesid = $request->input('salesid');


                    $comment_msg = strip_tags($message);
                    $comment_note = str_replace('$lb', PHP_EOL, $comment_msg);

                    $sms_code = $this->send_sms(str_replace(" ", "", $phone), $comment_note, 4 , $app_id);  // SendSMS Traits
                   // $statusCode = $sms_code->getStatusCode();
                    $statusCode = $sms_code;
                   //  dd($sms_code);
                     $heading = $subject;
                     
                    if ($statusCode === 1) {
                       $heading .= " (Delivered)";
                       $status = 'Success';
                    } else {
                      $heading .= ' <span style="color:red;">(Failed)</span>';
                       $status = 'Error';
                    }

                     $heading .= ' On '.$phone;

                    $this->add_application_notes($app_id,$heading,$comment_note ,'','','', 0);
                    $this->addNoteswithTrackManager($salesid ,  0 , $heading , 3);
                    return response()->json(['message'=>$heading,'status'=>$statusCode]);

                }else{
                    return response()->json('Not valid request');
                }
            }

}