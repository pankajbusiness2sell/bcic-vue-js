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
use App\Models\Jobs;
use App\Models\JobReclean;
use App\Models\Staff;
use App\Models\StaffJobsStatus;


class JobPopup extends MasterController
{
    // 
        // use SendSMS, AllNotes EmailTemplates;
        public function __construct()
        {
                $this->middleware('auth');
                
        }
     

        public function jobpopup(Request $request)
        {

            $action = $request->input('tab');
            $job_id = $request->input('job_id');

            return view('job_popup.job_popup', ['job_id'=>$job_id,'tab'=>$action]);

        }

        function saveCustSecondInfo(Request $request){

            if($request->expectsJson()) 
            {
                $qid = $request->input('quote_id' , 0);
                $j_id = $request->input('job_id');
                $name = $request->input('name');
                $email = $request->input('email');
                $mobile = $request->input('phone');

                if ($j_id != 0) {
                    // Insert data into the job_client_other_info table
                    DB::table('job_client_other_info')->insert([
                        'quote_id' => $qid,
                        'job_id' => $j_id,
                        'secondary_name' => $name,
                        'secondary_email' => $email,
                        'secondary_number' => $mobile,
                        'createdOn' => Carbon::now(),
                    ]);
                
                    // Prepare heading text
                    $heading = "Add New Secondary Client  (" . $mobile . ")  info";

                    $this->add_job_notes($j_id , $heading, $heading);

                    return response()->json(true);
                }

            } else{
                return response()->json('Not valid request');
            }
        }

        function getSeconInfo(Request $request) {
            if($request->expectsJson()) 
            {
              // dd($request->all());
              $j_id = $request->input('job_id');
              $getclientInfo = DB::table('job_client_other_info')->where('job_id', $j_id)->orderBy('id','DESC')->get();
              $getInfo = (!empty($getclientInfo)) ? $getclientInfo : [];
              return response()->json(['cinfo'=>$getInfo]);
            }else{
                return response()->json('Not valid request');
            }
        }


        function getJobPopupDetails(Request $request) 
        {

            if($request->expectsJson()) 
            {
                 //dd($request->all());
                $job_id = $request->input('jobid');

                $ddValue = dd_in_value([29,26,122,35,133,65,40,106,127,87,208,174]);
                $admindata = $this->GetAdmin();
                //dd($ddValue);

                $jobDetailsall = Jobs::select('id', 'site_id','get_entry','cleaner_park', 'work_guarantee_text','work_guarantee','customer_payment_method','customer_paid', 'quote_id', 'job_date', 'status', 'customer_amount', 'accept_terms_status',
                                'review_email', 'estimate_status', 'assigning_status','customer_paid_date', 'invoice_status', 'job_assign_status', 'online_payment_status',
                                'deposit', 'upsell_denied', 'upsell_required', 'upsell_admin','email_client_booking_conf','email_client_cleaner_details','sms_client_cleaner_details')
                    ->with(['quoteInfo' => function ($query) {
                        $query->select('name', 'id', 'site_id', 'quote_for', 'have_removal', 'suburb', 'booking_id', 'amount', 'step', 'address', 'job_ref',
                            'email', 'phone', 'moving_from', 'moving_to', 'is_flour_from', 'is_lift_from', 'house_type_from', 'door_distance_from',
                            'is_flour_to', 'is_lift_to', 'house_type_to', 'door_distance_to', 'contact_type', 'mode_of_contact', 'booking_date',
                            'date', 'estimate_status', 'login_id');
                    }, 'jobdetails' => function ($query) {
                        $query->select('job_id', 'status','team_size','quote_id', 'id', 'amount_total', 'staff_id', 'job_type', 'start_time', 'start_time_admin', 'end_time',
                            'job_type_id', 'sub_staff_assign_date', 'sub_staff_id', 'real_estate_agency_name', 'agent_address' , 'agent_landline_num' , 'agent_name',
                            'agent_number','agent_email');
                    }])
                    ->findOrFail($job_id);

                    $jobdetails = $jobDetailsall->jobdetails; // Retrieve the jobdetails relationship
                    // Group by job_type_id
                    //$groupedJobDetails = $jobdetails->groupBy('job_type_id');
                    
                    // Convert to array if needed
                    $groupedJobDetailsArray = $jobdetails->toArray();

                    $getSubStafff = []; // Initialize sub staff tracking array
                    $start_time = 'Not Available'; // Default start time
                    $end_time = 'Not Available';   // Default end time
                    $upsell = 'N/A';
                    $startEndShow = false;
                    $total_work = 0;
                    $extra_hr = 0;
                    $teamSize = 1;
                    $quoteworkHours = 0;
                    $work_hr = 0;

                    $totalAmt = $this->totalAmountofJob($job_id);

                    $requoteDetails = DB::table('re_quoteing')->select('id','est_sqm','sqm')->where('job_id', $job_id)->first();
                     // Check if the grouped array is not empty
                     if (!empty($groupedJobDetailsArray)) {
                        foreach ($groupedJobDetailsArray as $key=>$detail) {

                             if($detail['staff_id'] > 0) {
                                $staffInfo = DB::table('staff')->select('name','mobile')->where('id', $detail['staff_id'])->first();

                                $groupedJobDetailsArray[$key]['staffinfo'] = $staffInfo->name. ' | '.$staffInfo->mobile;
                             }else{
                                $groupedJobDetailsArray[$key]['staffinfo']  = '';
                             }
                            //$staff_id = $detail['staff_id'];        
                            // Check if the job type ID is 1 or 8
                            if ($detail['job_type_id'] == 1 || $detail['job_type_id'] == 8) {
                    
                                // Retrieve work hours from the database
                                $getworkhr = DB::table('quote_details')
                                    ->select('hours')
                                    ->where('job_type_id', $detail['job_type_id'])
                                    ->where('quote_id', $detail['quote_id'])
                                    ->first();
                    
                                // Ensure $getworkhr is not null
                                $quoteworkHours = $getworkhr ? $getworkhr->hours : 0;
                    
                                // Format start time
                                $start_time = ($detail['start_time'] != '0000-00-00 00:00:00') 
                                    ? Carbon::parse($detail['start_time'])->format('h:i:s A') 
                                    : 'Not Started';
                    
                                // Format end time
                                if ($detail['end_time'] != '0000-00-00 00:00:00') {
                                    $end_time = Carbon::parse($detail['end_time'])->format('h:i:s A');
                                    $upsell = $detail['upsell'] ?? 'N/A'; // Check if upsell exists
                                } else {
                                    $end_time = 'Not Finished';
                                }
                    
                                // Track sub staff if exists
                                if ($detail['sub_staff_id'] != 0) {
                                    $getSubStafff[$detail['sub_staff_id']] = $detail['sub_staff_assign_date'];
                                }
                    
                                $startEndShow = true;
                    
                                // Calculate work hours if both start and end times are available
                                if ($detail['end_time'] != '0000-00-00 00:00:00' && $detail['start_time'] != '0000-00-00 00:00:00') {
                                    $start = Carbon::parse($detail['start_time']);
                                    $end = Carbon::parse($detail['end_time']);
                                    $interval = $end->diff($start);
                    
                                    $work_hr = $interval->h . '.' . $interval->i;
                                    $teamSize = $detail['team_size'] ?? 1; // Default to 1 if team_size is not set
                    
                                    // Calculate total work
                                    $total_work = $teamSize * $work_hr;
                    
                                    // Determine extra hours
                                    $extra_hr = ($total_work > $quoteworkHours) ? $total_work - $quoteworkHours : 0;
                                    if(!empty($extra_hr)){
                                        $extra_hr = round(($total_work - $quoteworkHours), 2);
                                    }
                                    
                    
                                } else {
                                    $total_work = 0;
                                    $work_hr = 0;
                                    $extra_hr = 0;
                                }
                            }
                        }
                    }
                
                $jobDetailsall->sqm = (!empty($requoteDetails->sqm)) ? $requoteDetails->sqm : '';
                $jobDetailsall->requote_id = (!empty($requoteDetails->id)) ? $requoteDetails->id : 0;
                $jobDetailsall->start_time = $start_time;
                $jobDetailsall->end_time = $end_time;
                $jobDetailsall->upsell = $upsell;
                $jobDetailsall->startEndShow = $startEndShow;
                $jobDetailsall->teamSize = $teamSize;

                $jobDetailsall->total_work = $total_work;
                $jobDetailsall->work_hr = $work_hr;
                $jobDetailsall->extra_hr = $extra_hr;
                $jobDetailsall->quoteworkHours = $quoteworkHours;
                $jobDetailsall->totalAmt = $totalAmt;

                

                // dd($jobDetailsall);

                return response()->json(['allInfo'=>$jobDetailsall,'ddValue'=>$ddValue,'admindata'=>$admindata,'jobdetails'=>$groupedJobDetailsArray ]);

            }else{
                return response()->json('Not valid request');
            }

        }

        function sendEmailPopup(Request $request) {

              // dd($request->all());
              if($request->expectsJson()) 
              {
                    $job_id = $request->input('job_id');
                    $emailtype = $request->input('emailtype');
                   
                    $text = '';
                    if($emailtype == 'email_client_booking_conf') {
                           $str  = $this->sendEmailConf($job_id);
                           $text = 'Send email Booking Confirmation';
                    } elseif($emailtype == 'email_client_cleaner_details') {
                          $str = $this->sendCleanerDetailsEmails($job_id);
                          $text = 'Send email Client to Cleaner details ';
                    } elseif($emailtype == 'sms_client_cleaner_details') { 
                          $str = $this->send_cleaner_details_to_clients($job_id);
                          $text = 'Send sms Client to Cleaner details ';
                    } 
                    $jobsInfo =  Jobs::select('email_client_booking_conf','email_client_cleaner_details','sms_client_cleaner_details')->where('id', $job_id)->first();
                    $time = Carbon::now()->format('dS M Y H:i A');
                    return response()->json(['jobsinfo'=>$jobsInfo, 'message'=>$text]);
                
              }else{

                  return response()->json('Not valid request');
              }

        } 

        function getJobListData(Request $request) {

            // dd($request->all());

            if($request->expectsJson()) 
            {

                $job_id = $request->input('job_id' , 0);
                $notestype = $request->input('notestype' , 1);

                if($notestype == 1) {
                    $getjoblist =  $this->get_job_list($job_id);
                }else  if($notestype == 2) {
                    $getjoblist =  $this->get_staff_list($job_id);
                }else  if($notestype == 3) {
                    $getjoblist =  $this->get_highlight_list($job_id);
                }else  if($notestype == 4) {
                    $getjoblist =  $this->get_3pm_note_list($job_id);
                }
                 
               return response()->json(['job_note'=>$getjoblist]);

            }else{

                return response()->json('Not valid request');
            }
        }

        function addJobNotes(Request $request) {

            if($request->expectsJson()) 
            { 
                $job_id = $request->input('job_id');
                $comment = $request->input('comment');
                $notestype = $request->input('notestype');

                 
                if(!empty($comment)) {
 
                     $getjoblist = [];
                     
                    if($notestype == 1) {
                        $heading = 'Add Job Notes';
                        $this->add_job_notes($job_id,$heading,$comment);
                        $getjoblist =  $this->get_job_list($job_id);
                    }else  if($notestype == 2) {
                        $staffids = JobDetail::where('job_id', $job_id)->where('status', 0)->where('staff_id','>' , 0)
                                                ->pluck('staff_id')->unique();

                        
                        if(!empty($staffids)) {
                            $heading = 'Add Staff Notes';
                            foreach($staffids as $key=>$staff_id) {
                                $this->add_staff_notes($staff_id , $job_id,$heading,$comment);
                                $this->sendNotification($comment, $staff_id);
                            }

                            $this->add_job_notes($job_id,$heading,$comment);
                        }
                        $getjoblist =  $this->get_staff_list($job_id);

                    }else  if($notestype == 3) {
                         $heading = 'Add Highlight Notes';
                         $this->add_highlight_notes($job_id,$heading,$comment);
                         $getjoblist =  $this->get_highlight_list($job_id);
                    }else  if($notestype == 4) {
                        
                        $staffids = JobDetail::where('job_id', $job_id)->where('status', 0)
                        ->pluck('staff_id','id')->unique();

                        if(!empty($staffids)) {
                            $heading = 'Add 3 PM  Notes';
                            foreach($staffids as $key=>$staff_id) {
                                $this->add_3pm_notes($job_id, 0, $key, 3 ,$heading,$comment);
                            }
                            $this->add_job_notes($job_id,$heading,$comment);
                        }

                        $getjoblist =  $this->get_3pm_note_list($job_id);
                    }
                   
                    return response()->json(['job_note'=>$getjoblist]);
                }

                //add_staff_notes

            }else{
                return response()->json('Not valid request');
            }

        }


        public function getJobDetails(Request $request)
        {
            $job_id = $request->input('job_id');
           $job_details =  $this->getjobDetailsJobType($job_id);
            return response()->json($job_details);
        }

            // public function getJobDetails(Request $request)
            // {
            //     $job_id = $request->input('job_id');

            //     // Define a unique cache key
            //     $cacheKey = 'job_details_' . $job_id;

            //     // Cache the job details for 60 minutes
            //     $job_details = Cache::remember($cacheKey, 60, function() use ($job_id) {
            //         return $this->getjobDetailsJobType($job_id);
            //     });

            //     return response()->json($job_details);
            // }

        function getjobType(Request $request) {

                $jobId = $request->input('job_id'); // Assuming $jobs['id'] holds the job ID
                $jobTypes = JobType::whereNotIn('id', function($query) use ($jobId) {
                    $query->select('job_type_id')
                    ->from('job_details')
                    ->where('job_id', $jobId)
                    ->where('status', '!=', 2);
                })
                ->where('id', '!=', 11)
                ->select('id', 'name')
                ->get();

               return  response()->json($jobTypes);
        }
        
        function getstaffType(Request $request) {
              
             // dd($request->all());
             if($request->expectsJson()) 
             { 
                    $job_id = $request->input('job_id');
                    $site_id = $request->input('site_id');
                    $selectedJobName = (!empty($request->input('selectedJobName'))) ? $request->input('selectedJobName') : '';
                    $selectedId = (!empty($request->input('selectedId'))) ? $request->input('selectedId') : ''; //$request->input('selectedId');

                    $staffinfo = Staff::select('id','name')->where(function($query) use ($site_id) {
                        $query->where('site_id', $site_id)
                            ->orWhere('site_id2', $site_id)
                            ->orWhereIn('all_site_id', [$site_id]);
                    });

                    if(!empty($selectedJobName)) {
                    $staffinfo->whereRaw('FIND_IN_SET(?, job_types)', [$selectedJobName]);
                    }
                    $staffinfo->where('status', 1)
                    ->where('no_work', 1);

                    $staffinfoData = $staffinfo->get();

                return  response()->json($staffinfoData);
            }else{
                return response()->json('Not valid request');
            }
        }

        function addJobType(Request $request) {
            
            if($request->expectsJson()) 
            { 
                // dd($request->all());

                    // $errors = [];
                    //  if(empty($request->input('job_type_id'))) {
                    //       $errors['job_type_id'] = 'Please select job type';
                    //  }

                    //  if(empty($request->input('staff_id'))) {
                    //     $errors['staff_id'] = 'Please select staff name';
                    //  }

                    // if(count($errors) > 0) {
                    //     return response()->json(['success' => false ,'errors'=>$errors]);
                    // }

                $job_id = $request->input('job_id');
                $site_id = $request->input('site_id');
                $job_type_id = $request->input('job_type_id');
                $staff_id = $request->input('staff_id');
                $job_date = $request->input('job_date');
                $job_time = $request->input('job_time');
                $quote_id = $request->input('quote_id');
                $amount_staff = $request->input('staff_amount');
                $amount_profit = $request->input('bcic_profit');
                $amount_total = $request->input('job_amount');


                if (!empty($job_id) && !empty($job_type_id)) {
                   
                        // Fetch job type name
                        $job_type = DB::table('job_type')->where('id', $job_type_id)->value('name');
            
                        // Insert job details
                        JobDetail::insert([
                            'job_id' => $job_id,
                            'quote_id' => $quote_id,
                            'site_id' => $site_id,
                            'job_type_id' => $job_type_id,
                            'job_type' => $job_type,
                            'staff_id' => $staff_id,
                            'job_date' => $job_date,
                            'job_time' => $job_time,
                            'amount_total' => $amount_total,
                            'amount_staff' => $amount_staff,
                            'amount_profit' => $amount_profit,
                        ]);
            
                        // Recalculate the total (assuming you have this function)
                        $this->recalcJobTotal($job_id , $quote_id);
                        // Add job notes
                        $heading = "Add New Job " . $job_type;
                        $this->add_job_notes($job_id, $heading, $heading);

                        $job_details =  $this->getjobDetailsJobType($job_id);

                        return  response()->json(['job_details'=>$job_details,'success' => true,'message' => $job_type.' Job added successfully']);
                }else{
                      $job_details =  $this->getjobDetailsJobType($job_id);
                    return  response()->json(['job_details'=>$job_details,'success' => false,'message' => ' Please select job type']);
                }

            }
              else
            {

                return response()->json('Not valid request');
            }

        }

        function AssignJobs(Request $request) 
        {
              
             $job_id = $request->input('job_id');
             $staff_id = $request->input('staff_id');
             $jd_id = $request->input('jid');
             $type = $request->input('type');

              if(!empty($type) && ($type == 3)) {
                    //$quote_id = get_rs_value('jobs','quote_id', $job_id);
                    $jobdetails = JobDetail::select('job_type','job_id','quote_id','job_type_id')->where('id',$jd_id)->first();
                    $jobDetail = JobDetail::where('id',$jd_id)->update(['status' => 2]);
                    $this->recalcJobTotal($job_id , $jobdetails->quote_id);
                    $heading = 'Delete '.$jobdetails->job_type. ' job type';
                    $this->add_job_notes($job_id, $heading ,  $heading);
                    $job_details =  $this->getjobDetailsJobType($job_id);
                    return  response()->json(['job_details'=>$job_details,'success' => true,'message' => $heading.' successfully']);
                    exit();
              }
             // Fetch job details

                        $jobDetail = JobDetail::find($jd_id);
                        if (!$jobDetail) {
                            return response()->json(['error' => 'Job detail not found'], 404);
                        }

                        $job_date1 = (!empty($jobDetail->job_date) && $jobDetail->job_date != '0000-00-00') ? $jobDetail->job_date : '0000-00-00';

                        // Default values
                        $staff_truck_assign_date = null;
                        $staff_truck_id = 0;
                        $amount_status = 1;
                        $not_accepted_staff = 0;

                        // Initialize values for staff if not assigned
                        $staff_assign_date = $staff_id == 0 ? null : now();
                        $staff_assign_notification = $staff_id == 0 ? '' : 0;
                        $job_acc_deny = $staff_id == 0 ? 'Null' : 0;
                        $amount_staff = $amount_profit = 0;
                        $amt_share_type = $staff_work_status = $checklist_field = '';
                        $auto_assign = $staff_id == 0 ? 0 : 2;
                        $staffname = '';
                       

                        if ($staff_id != 0) {
                            $quoteDetails = QuoteDetails::select('hours')->where('quote_id', $jobDetail->quote_id)
                                ->where('job_type_id', $jobDetail->job_type_id)
                                ->first();

                               // dd($quoteDetails);
                           
                            if (!empty($quoteDetails)) {

                                // Other job type logic
                                $getshareamount = DB::table('staff_share_amount')->where('job_type_id', $jobDetail->job_type_id)
                                    ->where('staff_id', $staff_id)
                                    ->first();

                                $staffDetails =  Staff::select('id','name','carpet_share')->where('id', $staff_id)->first();   
                                $staffname = (!empty($staffDetails->name)) ? $staffDetails->name : ''; 
                                // dd($staffDetails->name);
                                //$staffDetails->carpet_share = 2;

                                if($jobDetail->job_type_id == 2 && $staffDetails->carpet_share == 2) {
                                   
                                        $carpetData = DB::table('carpet_fixed_rate')->where('staff_id', $staff_id)
                                        ->orderBy('id', 'desc')
                                        ->first();

                                        if (!empty($carpetData)) {

                                            $totalAmt = $jobDetail->amount_total;
                                        
                                            $room_set_Amt = $carpetData->room_set;
                                            $addition_room_Amt = $carpetData->addition_room;
                                            $addition_living_Amt = $carpetData->addition_living;
                                            $addition_stairs_Amt = $carpetData->addition_stairs;
                                        
                                            $bed = $quoteDetails->bed;
                                            $living = $quoteDetails->living;
                                            $carpet_stairs = $quoteDetails->carpet_stairs;
                                        
                                            $amount_staff = 0;
                                        
                                            if ($bed == 1) {
                                                $amount_staff += $room_set_Amt;
                                            } else {
                                                $amount_staff += ($room_set_Amt + (($bed - 1) * $addition_room_Amt));
                                            }
                                        
                                            if ($living > 0) {
                                                $amount_staff += $addition_living_Amt * $living;
                                            }
                                        
                                            if ($carpet_stairs > 0) {
                                                $amount_staff += $addition_stairs_Amt * $carpet_stairs;
                                            }
                                        
                                            $amount_profit = $totalAmt - $amount_staff;
                                            $amt_share_type = 'Crpt Rate';
                                            
                                           // echo $amt_share_type  $amount_profit. ' == '.$amount_staff .' == ' .$totalAmt; 90 == 30 == 120
                                           // echo  $amount_profit. ' == '.$staff_amount .' == ' .$totalAmt; 90 == 30 == 120

                                            // Insert into staff_jobs_status
                                            DB::table('staff_jobs_status')->insert([
                                                'staff_id' => $staff_id,
                                                'job_id' => $job_id,
                                                'status' => 5,
                                                'job_type_id' => $jobDetail->job_type_id,
                                                'created_at' => Carbon::now(),
                                                'total_amount' => $totalAmt,
                                                'total_staff_amt' => $amount_staff,
                                                'total_bcic_amt' => $amount_profit,
                                                'current_rate_for_day' => $amt_share_type,
                                                'assign_type' => 1,
                                                'login_id' => session('id'),
                                            ]);
                                        }


                                }else {
                                    if ($getshareamount->amount_share_type == 1) {
                                        $amount_profit = ($jobDetail->amount_total * $getshareamount->value) / 100;
                                        $amount_staff = ($jobDetail->amount_total - $amount_profit);
                                        $amt_share_type = $getshareamount->value . '(%)';
                                    } else if ($getshareamount->amount_share_type == 2) {
                                        $amount_staff = ($jobDetail->amount_total - $getshareamount->value);
                                        $amount_profit = ($jobDetail->amount_total - $amount_staff);
                                        $amt_share_type = $getshareamount->value . '(F)';
                                    } else if ($getshareamount->amount_share_type == 3) {
                                        $amount_profit = ($jobDetail->amount_total - $getshareamount->value * $quoteDetails->hours);
                                        $amount_staff = ($jobDetail->amount_total - $amount_profit);
                                        $amt_share_type = $getshareamount->value . '/ Clnr (Hours)';
                                    }
                                   
                                    // $amount_staff = $amountDetails['amount_staff'];
                                    // $amount_profit = $amountDetails['amount_profit'];
                                    // $amt_share_type = $amountDetails['amt_share_type'];

                                    $staff_assign_date = now();
                                    $staff_assign_notification = 0;
                                    $job_acc_deny = 0;

                                    DB::table('staff_jobs_status')->insert([
                                        'staff_id' => $staff_id,
                                        'job_id' => $job_id,
                                        'status' => 5,
                                        'job_type_id' => $jobDetail->job_type_id,
                                        'created_at' => now(),
                                        'total_amount' => $jobDetail->amount_total,
                                        'total_staff_amt' => $amount_staff,
                                        'total_bcic_amt' => $amount_profit,
                                        'current_rate_for_day' => $amt_share_type,
                                        'assign_type' => 1,
                                        'login_id' => session('id'),
                                    ]);
                                } 
                            }
                        }

                        $amtCal = (($jobDetail->amount_total * 39) / 100);

                       
                        $jobDetail->job_date = date('Y-m-11');
                        $job_date1  = (!empty($jobDetail->job_date) && $jobDetail->job_date != '0000-00-00') ? $jobDetail->job_date : '0000-00-00';

                        if ($amount_profit < $amtCal && $job_date1 == Carbon::tomorrow()->format('Y-m-d')) 
                        {

                            if (Carbon::now()->minute <= 30) {
                                $schedule_from = Carbon::now()->format('H') . ':00';
                                $schedule_to = Carbon::now()->format('H') . ':30';
                            } else {
                                $schedule_from = Carbon::now()->format('H') . ':30';
                                $schedule_to = Carbon::now()->addHour()->format('H') . ':00';
                            }
                        
                            $fallow_time = $schedule_from . '-' . $schedule_to;
                        
                            // Fallback for follow date
                            $fallow_date = $fallow_date ?? Carbon::now()->format('Y-m-d');
                        
                            $heading = 'J#' . $jobDetail->job_id . ' Under 39 %  Assign Jobs Pls check';
                           
                            $adminInfo = $this->getrolename(15);

                            // Prepare notification array
                            $notificationArrayData = [
                                'notifications_type' => 8,
                                'quote_id' => $jobDetail->quote_id,
                                'job_id' => $jobDetail->job_id,
                                'staff_id' => 0,
                                'noti_type' => 2,
                                'task_type' => 2,
                                'fallow_datetime' => $fallow_time,
                                'task_type_noti' => 0,
                                'priority_status' => 3,
                                'task_from' => session('id'),
                                'heading' => $heading,
                                'comment' => $heading,
                                'notifications_status' => 0,
                                'login_id' => $adminInfo['id'],
                                'staff_name' => $adminInfo['name'],
                                'date' => now()
                            ];

                            // Add site notifications and get the last inserted ID
                            $getlastid = DB::table('site_notifications')->insertGetId($notificationArrayData);

                            DB::table('sales_task_track')->insert([
                                'quote_id' => $jobDetail->quote_id,
                                'notification_id' => $getlastid,
                                'job_id' => $jobDetail->job_id,
                                'heading' => $heading,
                                'comment' => $heading,
                                'task_status' => 1,
                                'staff_name' => $adminInfo['name'],
                                'admin_id' => $adminInfo['id'],
                                'site_id' => 0,
                                'status' => 1,
                                'fallow_date' => $fallow_date,
                                'fallow_time' => $fallow_time,
                                'task_assign_type' => 1,
                                'fallow_created_date' => Carbon::now()->format('Y-m-d'),
                                'task_manage_id' => $adminInfo['id'],
                                'task_type' => 'reclean',
                                'track_type' => 4,
                                'createOn' => now()
                            ]);

                        }

                            // $jobDetail->update(
                            // Update job details
                            JobDetail::where('id', $jobDetail->id)->update([
                                'staff_id' => $staff_id,
                                'staff_truck_assign_date' => $staff_truck_assign_date,
                                'checklist_status' => (!empty($checklist_status)) ? $checklist_status : 0,
                                'staff_truck_id' => $staff_truck_id,
                                'job_notification_status' => 0,
                                'job_notification_date' => (!empty($job_notification_date) && $job_notification_date != '0000-00-00 00:00:00') ? $job_notification_date : '0000-00-00 00:00:00',
                                'add_notification_status' => 0,
                                'add_notification_date' => (!empty($add_notification_date) && $add_notification_date != '0000-00-00 00:00:00') ? $add_notification_date : '0000-00-00 00:00:00', 
                                'job_sms' => '',
                                'address_sms' => '',
                                'job_sms_date' => '0000-00-00 00:00:00',
                                'start_time' => '0000-00-00 00:00:00',
                                'end_time' => '0000-00-00 00:00:00',
                                'address_sms_date' => '0000-00-00 00:00:00',
                                'staff_assign_date' => (!empty($staff_assign_date) && $staff_assign_date != '0000-00-00 00:00:00') ? $staff_assign_date : '0000-00-00 00:00:00',  
                                'sub_staff_id' => (!empty($sub_staff_id)) ? $sub_staff_id : 0,
                                'sub_staff_assign_date' => (!empty($sub_staff_assign_date) && $sub_staff_assign_date != '0000-00-00 00:00:00') ? $sub_staff_assign_date : '0000-00-00 00:00:00', 
                                'exact_work_time' => '',
                                'total_hr_staff_work' => '',
                                'staff_assign_notification' => $staff_assign_notification,
                                'job_acc_deny' => $job_acc_deny,
                                'amount_staff' => $amount_staff,
                                'amount_status' => $amount_status,
                                'staff_work_status' => $staff_work_status,
                                'checklist_field' => $checklist_field,
                                'amount_profit' => $amount_profit,
                                'not_accepted_staff' => $not_accepted_staff,
                                'amt_share_type' => $amt_share_type,
                            ]);

                        if($staff_id == 0) {
                            $adminname =  session('name');
                            $heading = $jobDetail->job_type .' Reset';
                        }else {
                            $staffname = $staffname; // get_rs_value('staff','name', $staff_id);
                            $heading = ' Assign ' . $jobDetail->job_type .'  Job to '.$staffname;
                        }
                        
                        $this->add_job_notes($job_id, $heading ,  $heading);
                        $job_details =  $this->getjobDetailsJobType($job_id);
                        return  response()->json(['job_details'=>$job_details,'success' => true,'message' => $heading.' successfully']);
        }


        function ReCleanNotes(Request $request) {
 
            $job_id = $request->input('job_id');
            $type = $request->input('type');
            $recleanData = $this->get_reclean_list($job_id , $type);
           // $recleanData =  DB::table('reclean_notes')->where('job_id' , $job_id)->orderBy('id', 'DESC')->get();
            return response()->json(['all_notes'=>$recleanData]);
        }

        function AddReCleanNotes(Request $request) {

              $job_id = $request->input('job_id');
              $commenttext = $request->input('commenttext');
              $quote_id = $request->input('quote_id' , 0);
              $Notestype =  (!empty($request->input('Notestype')) && $request->input('Notestype') == 2) ? 1 : 0;

              $getNotesType = $request->input('Notestype');
              $heading = 'Add Reclean Notes';

              if(!empty($commenttext)) {
                  $this->add_reclean_notes($job_id , $heading , $commenttext , '','','','', $quote_id, $Notestype);
              }
             
              $recleanData = $this->get_reclean_list($job_id , $getNotesType);
              return response()->json(['all_notes'=>$recleanData]);

        }

   /*
 // Payment 24 Sep 2024
  
   */

        function getPaymentData(Request $request) {
            
             $job_id = $request->input('job_id');
             $quote_id = $request->input('quote_id');
             $site_id = $request->input('site_id');
 
            if($request->expectsJson()) 
            { 
                    // $jobDetailsall = Jobs::select('id', 'accept_terms_status')
                    // ->with(['quoteInfo' => function ($query) {
                    //     $query->select('name', 'id', 'site_id',  'phone');
                    // }])
                    // ->findOrFail($job_id);
                    $jobDetailsall = Jobs::select('jobs.id', 'jobs.accept_terms_status', 'quote_new.name', 'quote_new.id as quote_id', 'quote_new.site_id', 'quote_new.phone')
                            ->join('quote_new', 'quote_new.booking_id', '=', 'jobs.id')
                            ->where('jobs.id', $job_id)
                            ->first();
                            
                return response()->json(['quotedetails'=>$jobDetailsall]);
            }
             else
            {

                return response()->json('Not valid request');
            }

             //  dd($jobDetailsall);
        }

        public function addPayment (Request $request) {

            if($request->expectsJson()) 
            {
                $job_id = $request->input('job_id');
                $quote_id = $request->input('quote_id');
                $p_date = $request->input('p_date' , date('Y-m-d'));
                $p_amount = $request->input('p_amount' , 0);
                $p_payment_method = $request->input('p_payment_method');
                $p_taken_by = $request->input('p_taken_by', 'BCIC');
                $voucher_text = $request->input('voucher_text');


                 if(!empty($job_id)) {
                    
                    $this->add_job_notes($job_id, "Payment of $" . $p_amount . " Payment method ( " . $p_payment_method . " ) Taken By " . $p_taken_by, '');
                    $payStatus = '';
                    $flag = 0;

                    if ($p_amount < 0) {
                        $payStatus = 'Refund';
                        DB::table('job_payments')->insert([
                            'job_id' => $job_id,
                            'payment_method' => $p_payment_method,
                            'payment_card_status' => 3,
                            'date' => $p_date,
                            'amount' => $p_amount,
                            'transaction_type' => $payStatus,
                            'login_id' => Auth::id(),
                            'taken_by' => $p_taken_by
                        ]);
                    } else {
                        $pending_page_status = $p_payment_method == 'Bank Transfer' && $p_taken_by != 'BCIC' ? 1 : 0;
                        $payment_card_status = $p_payment_method == 'Bank Transfer' ? ($p_taken_by != 'BCIC' ? 1 : 2) : 1;
                        $payStatus = 'Credit';
                        $flag = 1;
            
                        DB::table('job_payments')->insert([
                            'job_id' => $job_id,
                            'payment_method' => $p_payment_method,
                            'pending_page_status' => $pending_page_status,
                            'payment_card_status' => $payment_card_status,
                            'date' => $p_date,
                            'amount' => $p_amount,
                            'transaction_type' => $payStatus,
                            'login_id' => Auth::id(),
                            'taken_by' => $p_taken_by
                        ]);
                    }


                    $job_payment = DB::table('job_payments')
                    ->where('job_id', $job_id)
                    ->where('deleted', 0)
                    ->sum('amount');

                    $job_details_amt = DB::table('job_details')
                        ->where('job_id', $job_id)
                        ->where('status', '!=', 2)
                        ->sum('amount_total');

                    // Set invoice status
                    if ($job_payment == 0) {
                        $invoice_status = 0;
                    } elseif ($job_payment < $job_details_amt) {
                        $invoice_status = 2;
                    } elseif ($job_payment >= $job_details_amt) {
                        $invoice_status = 1;
                    }

                    Jobs::where('id', $job_id)->update([
                        'customer_paid_amount' => $p_amount,
                        'customer_paid' => 1,
                        'customer_paid_date' => now(),
                        'invoice_status' => $invoice_status,
                        'customer_payment_method' => $p_payment_method,
                    ]);

                    $jobPaymentHistory = $this->_paymentlist($job_id);
                    return response()->json(['payment_list'=>$jobPaymentHistory]);
                 }

            } else
            {

                return response()->json('Not valid request');
            }

        }

        function getPaymentlist(Request $request) {

            $job_id = $request->input('job_id');
            $jobPaymentHistory = $this->_paymentlist($job_id);
            return response()->json(['payment_list'=>$jobPaymentHistory]);

        }

        function getStafflist(Request $request) {

             $job_id = $request->input('job_id');
             
                $staff = DB::table('staff')->select('id','name','mobile')
                ->whereIn('id', function ($query) use ($job_id) {
                    $query->select('staff_id')
                        ->from('job_details')
                        ->where('job_id', $job_id)
                        ->where('status', '!=', 2);
                })
                ->get();

                return response()->json(['cleanerlist'=>$staff]);
        }

        function RefundPaymentAdd(Request $request) {
             
             //dd($request->all());

            if($request->expectsJson()) 
            {
                  $job_id =   $request->input('job_id');
                  $quote_id = $request->input('quote_id');
                  $r_amount = $request->input('r_amount');
                  $transaction_id = $request->input('transaction_id');
                  $ref_fault_status = $request->input('ref_fault_status');
                  $ref_cleaner_id = $request->input('ref_cleaner_id');
                  $ref_comment = $request->input('ref_comment');

                   // Create heading
                $heading = $r_amount . ' Refund By ' . session('name') . ' and transaction id (' . $transaction_id . ')';

                $paymentStatus = DB::table('job_payments')->where('transaction_id', $transaction_id)->first();
                $paymenttype = $paymentStatus->payment_type ?? 0;

                // Get the current timestamp
                $customDate = now();

                // Retrieve staff name from session
                $admin_id = session('id');
                $staff_name = session('name');

                // Insert data into the refund_amount table
                DB::table('refund_amount')->insert([
                    'job_id' => $job_id,
                    'created_date' => $customDate,
                    'eway_payment_type' => $paymenttype,
                    'heading' => addslashes($heading), // Similar to mysql_real_escape_string
                    'comment' => addslashes($ref_comment),
                    'login_id' => $admin_id,
                    'amount' => $r_amount,
                    'transaction_id' => $transaction_id,
                    'fault_status' => $ref_fault_status,
                    'cleaner_name' => $ref_cleaner_id,
                    'staff_name' => $staff_name
                ]);

                $this->add_job_notes($job_id, $heading, $ref_comment);
                $refundlist = $this->getRefundList($job_id);

                return response()->json(['refundlist'=>$refundlist]);

            }else
            {

                return response()->json('Not valid request');
            }

        }

        function refundlistdata(Request $request){

            if($request->expectsJson()) 
            {
                $job_id =   $request->input('job_id');
                $refundlist = $this->getRefundList($job_id);
                return response()->json(['refundlist'=>$refundlist]);
            }else
            {
                return response()->json('Not valid request');
            }
        }

        function getEmailList(Request $request) {

            if($request->expectsJson()) 
            { 
                $emailTemplate = DB::table('email_tpl')->get()->KeyBy('id');
                return response()->json(['emailTpl'=>$emailTemplate]);

            }else
            {
                return response()->json('Not valid request');
            }
        }

        function getEmailMessage(Request $request) 
        {
            if($request->expectsJson()) 
            { 
                 $job_id = $request->input('job_id');
                 $emailTypeid = $request->input('emailTypeid');
                 $message = $request->input('message');

                 if ($emailTypeid == "1") {
                    $afterReplaceText =  $this->sendEmailConfTemplate($job_id);
                    return response()->json(['emailMsg'=>strip_tags($afterReplaceText)]);
                } elseif ($emailTypeid == "2") {
                    $quote = QuoteNew::where('booking_id', $job_id)->first(); 
                         $afterReplaceText = $this->sendCleanerDetailsTemp($job_id , $quote);
                         $afterReplaceText = str_replace("<br>","\r",$afterReplaceText); 
                         return response()->json(['emailMsg'=>strip_tags($afterReplaceText)]);
                } else {


                        $guaranteeText = Jobs::where('id', $job_id)->value('work_guarantee_text');
                        $siteUrl = $this->siteUrl();

                        $qdetails = DB::table('quote_new')
                            ->select('id', 'name', 'ssecret', 'booking_id')
                            ->where('booking_id', $job_id)
                            ->first();

                        $url = $siteUrl . "/no_guarantee.php?action=imagecheck&jobid=" . $job_id;
                        $getURL = $this->shortUrl($url,'json');
                        $linkClick = "<a href=" . $getURL . " target='_blank'>" . $getURL . "</a>";

                        $text = ['$name', '$jobid', '$imgLink', '$bgtextarea'];
                        $replaceValue = [
                            htmlspecialchars($qdetails->name, ENT_QUOTES, 'UTF-8'),
                            htmlspecialchars($qdetails->booking_id, ENT_QUOTES, 'UTF-8'),
                            $linkClick,
                            $guaranteeText
                        ];

                        $afterReplaceText = str_replace($text, $replaceValue, $message);

                       return response()->json(['emailMsg'=>strip_tags($afterReplaceText)]);

                            // if ($flag) {
                            //     return strip_tags($afterReplaceText);
                            // } else {
                            //     return strip_tags($afterReplaceText);
                            // }
                }



            }else
            {
                return response()->json('Not valid request');
            }
                 
        }

        function sendPopupEmail(Request $request) {
            if($request->expectsJson()) 
            { 
                $job_id = $request->input('job_id');
                $template_id = $request->input('template_id');
                $email = $request->input('email');
                $subject = $request->input('subject');
                $message = $request->input('message'); 
                
                //$message = str_replace("<br>","\r",$message); 

                $quote = QuoteNew::select('id','email','name')->where('booking_id', $job_id)->first();

                $quotedata['name'] = $quote->name;
                $quotedata['email'] = $quote->email;
                 $sendfrom  = 'bookings@bcic.com.au';
                $this->sendemail($message , $quotedata, $subject,$sendfrom);
                $this->addJobEmails($job_id, $subject, $message, $quote->email);
                $subject1 = $subject .' Send Email On Popup';
                $this->add_job_notes($job_id, $subject1, $subject1);

                return response()->json(['message'=>$subject.' Sent successfully']);
            }else{
                return response()->json('Not valid request');
            }
        }
        

        function getSMSlist(Request $request) {

            if($request->expectsJson()) 
            { 
                //work_guarantee
                $emailTemplate = DB::table('work_guarantee')->get()->KeyBy('id');
                return response()->json(['smslist'=>$emailTemplate]);

            }else{
                return response()->json('Not valid request');
            }

        }

        function getSMSMsg(Request $request) {
            if($request->expectsJson()) 
            {
                // dd($request->all());

                //job_id , tplid , message
                $job_id = $request->input('job_id');
                $tplid = $request->input('tplid');
                $message = $request->input('message');
                $connectName =$request->input('connectName');

                $jobDetailsall = Jobs::with(['quoteInfo' => function ($query) {
                    $query->select('id', 'name', 'site_id', 'email', 'address', 'booking_date', 'booking_id'); // Include 'booking_id'
                }])
                ->select('id', 'site_id', 'imagelink', 'work_guarantee_text', 'customer_amount')
                ->findOrFail($job_id);

                // dd($jobDetailsall->quoteInfo);

                    $work_guarantee_text = $jobDetailsall->work_guarantee_text ?: '';
                    $imagelink = $jobDetailsall->imagelink ?: '';

                    $cname = $jobDetailsall->quoteInfo->name;  
                    $booking_date = ($jobDetailsall->quoteInfo->booking_date != '0000-00-00') ? date('dS M Y', strtotime($jobDetailsall->quoteInfo->booking_date)) : '';  
                    $site_id = $jobDetailsall->quoteInfo->site_id;  
                    $address = $jobDetailsall->quoteInfo->address;  
                    $customer_amount = $jobDetailsall->quoteInfo->customer_amount;  
                    $name = $jobDetailsall->quoteInfo->name;  

                    // Staff name extraction
                             $sname = (!empty($connectName)) ? explode('(', $connectName) : '';
                             $staffname = (!empty($sname[0])) ? $sname[0] : '';

                            // // Retrieve term condition link
                            $term_condition_link = DB::table('sites')->where('id', $site_id)->value('term_condition_link');
                            $link = '<a href="' . $term_condition_link . '" target="_blank">Click Here</a>';

                            $proctl = 'https://bit.ly/3mn4noo';


                            // Prepare the strings for replacement
                            $get_str = ['$date', '$name', '$jobid', '$bgtext', '$url', '$imglink', '$address', '$balance', '$staffname', '$productlink'];
                            $replace_str = [
                                $booking_date,
                                $cname,
                                '#' . $job_id,
                                $work_guarantee_text,
                                $term_condition_link,
                                $imagelink,
                                $address,
                                $customer_amount,
                                $staffname,
                                $proctl,
                            ];

                            // Retrieve the work guarantee text
                           // $term_condition_link = DB::table('work_guarantee')->where('id', $id)->value('work_guarantee_text');

                            // Replace strings in the work guarantee text
                            $str = str_replace($get_str, $replace_str, strip_tags($message));

                            return response()->json(['textStr'=>$str]);
                   // echo trim($str);
                 

                 // dd($jobDetailsall);
            }
              else
            {
                return response()->json('Not valid request');
            }
        } 

        function sendPopupSMS(Request $request) {

            if($request->expectsJson()) 
            {
                // dd($request->all());

                $job_id = $request->input('job_id');
                $connectName = $request->input('connectName');
                $template_id = $request->input('template_id');
                $phone = $request->input('phone');
                $smstype = $request->input('smstype');
                $message = $request->input('message');
                $optionVal = $request->input('optionVal', $connectName);
                $optionid = $request->input('optionid');
                
                if($template_id > 0) {
                    $work_guaranteeData = DB::table('work_guarantee')->select('email_type_data')->where('id',$template_id)->value('email_type_data');
                }else{
                     $work_guaranteeData = '';
                }
                
                $heading = '';
                $comment_msg = '';

                 if($optionid > 0 && $smstype == 2) {
                   
                        $comment_msg = strip_tags($message);
                        $this->sendNotification($comment_msg, $optionid);
                        $heading = $work_guaranteeData .' Send Notification to '.$optionVal;
                    

                 } else{

                    $comment_msg = strip_tags($message);
                   // $comment_note = str_replace('$lb', PHP_EOL, $comment_msg);
                    
                    $sms_code = $this->send_sms(str_replace(" ", "", $phone), $comment_msg, 2 , $job_id);  // SendSMS Traits
                   // $work_guaranteeData = DB::table('work_guarantee')->select('email_type_data')->where('id',$template_id)->first();

                    $heading = $work_guaranteeData.' sms send to '.$phone;
                    if($sms_code == 1) {
                        $heading.=" (Delivered)";
                    }else{
                        $heading.=" <span style=\"color:red;\">(SMS Failed)</span>";
                    }
                 }

                 $this->add_job_notes($job_id,$heading,$comment_msg);
                 return response()->json(['message'=>$heading]);

            }else{
                return response()->json('Not valid request');
            }

        }

        public function getJobRecleanDetails(Request $request)
        {
            if($request->expectsJson()) 
            {
                $job_id = $request->input('job_id');

                $job_details = JobReclean::where('job_id', $job_id)
                    ->where('status', '!=', 2)
                    ->with('staff') // Assuming there's a relationship for staff
                    ->get();
                // dd($job_details);
                return response()->json(['jobDetails'=>$job_details]);
            }else{
                return response()->json('Not valid request');
            }
        }

        public function getJobTypeforInv(Request $request)
        {
            if ($request->expectsJson()) {
                $job_id = $request->input('job_id');
        
                // Fetch job details with the desired conditions and relationships.
                $jobDetails = JobDetail::where('job_id', $job_id)
                    ->where('status', '!=', 2)
                    ->where('staff_id', '!=', 0)
                    ->whereIn('job_type_id', function ($query) {
                        $query->select('id')
                            ->from('job_type')
                            ->where('inv', 1);
                    })
                    ->orderBy('job_type_id', 'asc')
                    ->get(['id', 'staff_id', 'job_type_id', 'job_type']); // Select specific columns
        
                // Return the response
                return response()->json(['jobDetails' => $jobDetails]);
            }
        
            // Handle invalid request
            return response()->json(['error' => 'Not a valid request'], 400);
        }

        function getpopupEmailList(Request $request) {
            if ($request->expectsJson()) {
                  
                 $job_id = $request->input('job_id');

                // Fetch emails related to the job
                    $emails = DB::table('job_emails')->where('job_id', $job_id)->orderBy('date', 'desc')->get();

                    $emailIDs = $emails->pluck('bcic_email_id')->filter()->unique();
                    $emailNotes = DB::table('email_notes')->whereIn('email_id', $emailIDs)->orderBy('id', 'desc')->get();

                    return response()->json([
                        'emails' => $emails,
                        'emailNotes' => $emailNotes
                    ]);

            }

            return response()->json(['error' => 'Not a valid request'], 400);
        }

        function getTaskhistory(Request $request) {
            if ($request->expectsJson()) {
                $job_id = $request->input('job_id');
                $quopteid = $request->input('quote_id', 0);
        
                $taskHistory = SalesTaskTrack::where('track_type', '!=', 2)
                    ->where(function ($query) use ($job_id, $quopteid) {
                        $query->where('job_id', $job_id);
        
                        // Conditionally add the orWhere clause
                        if ($quopteid > 0) {
                            $query->orWhere('quote_id', $quopteid);
                        }
                    })
                    ->orderBy('id', 'desc')
                    ->get();
        
                return response()->json(['taskhistory'=>$taskHistory]);
            }
        
            return response()->json(['error' => 'Not a valid request'], 400);
        }

        function getrsvalue(request $request) {
            if ($request->expectsJson()) {

                 $id = $request->input('id');
                 $tableName = $request->input('tName');
                 $field = $request->input('field');
                 $data =  get_rs_value($tableName, $field, $id);
                 return response()->json(['valuename'=>$data]);

            }
             
            return response()->json(['error' => 'Not a valid request'], 400);
        }

        public function checklistUpdate(Request $request)
        {
            if ($request->expectsJson()) 
            {
                $jobId = $request->input('job_id');

                // Fetching data with Eloquent
                $jobChecklist = DB::table('job_checklist')->where('job_id', $jobId)
                    ->orderBy('checklist_type_id', 'asc')
                    ->get();

                $checkTypeArray = [
                    1 => 'Before Job',
                    2 => 'On the Day',
                    3 => 'Others'
                ];

                return response()->json(['jobChecklist' => $jobChecklist,'checkTypeArray' => $checkTypeArray]);
            }
                
            return response()->json(['error' => 'Not a valid request'], 400);

           
        }

        public function PopeditField(Request $request)
        {
            // Ensure the request expects a JSON response
            if ($request->expectsJson()) {
                // Retrieve request inputs
                $id = $request->input('id');
                $value = $request->input('value');
                $fieldname = $request->input('fieldname');
                $tablename = $request->input('tablename');

                // Check that required fields are present
                if ($id && $value && $fieldname && $tablename) {
                    // Update the field in the specified table
                    $updated = DB::table($tablename)->where('id', $id)->update([$fieldname => $value, 'createdOn' => date("Y-m-d H:i:S")]);

                    // Check if the update was successful
                    if ($updated) {
                        return response()->json(['success' => true, 'value'=>$value, 'message' => 'Field updated successfully'], 200);
                    }

                    // Handle the case where the update fails
                    return response()->json(['success' => false, 'message' => 'Field update failed'], 500);
                }

                // Handle invalid or missing parameters
                return response()->json(['success' => false, 'value'=>'', 'message' => 'Missing or invalid parameters'], 200);
            }

            // If the request is not expecting JSON, return a 400 error
            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }

        function saveCleanerNotes(Request $request) {

            if ($request->expectsJson()) {


                $job_id = $request->input('job_id');
                $cleaner_name = $request->input('cleaner_name');
                $notes_type = $request->input('notes_type');
                $notes_sub_type = $request->input('notes_sub_type');
                $comments = $request->input('comments');
                $cleanerName = $request->input('cleanerName');
                $notesName = $request->input('notesName');
                $note_type_new = $request->input('note_type_new');
                
                $jobdate = get_rs_value('jobs','job_date',$job_id);
                $faulttypeName = $notesName;
                
                $issueType =   dd_in_value([$note_type_new]);
                $subIssueType = (!empty($issueType)) ? ($issueType[$note_type_new][$notes_sub_type]) : '' ;
                //$issue_type = get_sql("system_dd","name"," where type=".$type." AND id='".$issue_type1."'");

                $heading = $faulttypeName .' = >' .$subIssueType.'  ('.$cleanerName.')';

                $this->add_cleaner_notes($job_id, $heading, $comments, $notes_sub_type, $cleaner_name, $notes_type, $jobdate);

                $cleanerNotes =  $this->get_cleaner_list($job_id);

                return response()->json(['success' => true, 'notesdata'=>$cleanerNotes,  'message' => 'Cleaner Notes added successfully'], 200);
 
            }
            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }

        function getCleanerNotesList (Request $request) {

                $job_id = $request->input('job_id');
                $cleanerNotes =  $this->get_cleaner_list($job_id);

                return response()->json(['success' => true, 'notesdata'=>$cleanerNotes,  'message' => 'Cleaner Notes added successfully'], 200);

        }

        public function showAssignHistory(Request $request)
        {
            if ($request->expectsJson()) 
            {
                $job_id = $request->input('job_id');
                
                // Query to get job details
                $jobDetails = DB::table('job_details')
                    ->select('job_id', 'job_type_id', 'job_type', 'site_id', 'job_date')
                    ->where('job_id', $job_id)
                    ->where('status', '!=', 2)
                    ->orderBy('job_type_id', 'asc')
                    ->get();
        
                $rows = [];
                $getAllDenied = [];
        
                foreach ($jobDetails as $data) {
                    // Assuming these methods return stdClass or array objects
                    $deniedData = $this->getJobDeniedStaffByReason($job_id, $data->job_type_id);
                    $availData = $this->checkAvailStaffData($data->site_id, $data->job_type_id, $data->job_date);
                    $getHaveJob = $this->getHaveJob($data->site_id, $data->job_type_id, $data->job_date);
        
                    // Extract denied staff names, assuming $deniedData is an object
                    $deniedStaff = isset($deniedData['sname']) ? $deniedData['sname'] : [];
        
                    // Handle available staff data, assuming $availData is an object
                    $availStaffIds = isset($availData->staffid) ? explode(',', $availData->staffid) : [];
                    $availStaff = array_diff($availStaffIds, $deniedStaff);
        
                    // Track all denied staff info
                    $getAllDenied[$data->job_type_id] = isset($deniedData['jobAllInfo']) ? $deniedData['jobAllInfo'] : [];
        
                    // Prepare row for table data
                    $rows[] = [
                        'job_type' => $data->job_type,
                        //'deniedlist' => implode(',', $deniedData['sname']),
                        'denied' => !empty($deniedStaff) ? implode(',', $deniedStaff) : 'N/A',
                        'available' => !empty($availStaff) ? implode(', ', $availStaff) : 'N/A',
                        'already_has_job' => !empty($getHaveJob->staffid) ? implode(', ', (array) $getHaveJob->staffid) : 'N/A'
                    ];
                }
        
                // Build Deny & Re-Assign History
                $denyReassignHistory = [];
        
                // dd($getAllDenied);
                $DenyArr = array(1=>'Admin', 2=>'Auto',3=>'Staff');
                $denyType1 = array(1=>'Deny',2=>'Re-Assign');
                foreach ($getAllDenied as $denyInfoArray) {
                    foreach ($denyInfoArray as $denyInfo) {
                        // Assuming $denyInfo is an object
                        $jobTypeName = DB::table('job_type')
                            ->where('id', $denyInfo->job_type_id)
                            ->value('name');
        
                        $reason = '';
                        $denyType = '';
                        if ($denyInfo->assign_type == 3) {
                            $denyDetails = $this->getReasonForDeny($denyInfo->job_id, $denyInfo->staff_id);
                            $reason = isset($denyDetails->reason_id) ? $denyDetails->reason_id : '';
                            $denyType = isset($denyDetails->deny_type) ? $denyType1[$denyDetails->deny_type] : '';
                        }
        
                        $denyReassignHistory[] = [
                            'staff_name' => $denyInfo->sname,
                            'deny_reassign_time' => $denyInfo->created_at,
                            'job_type' => $jobTypeName,
                            'deny_type' => (!empty($denyInfo->assign_type)) ?  $DenyArr[$denyInfo->assign_type] : '',
                            'reason_for_deny' => $reason,
                            'deny_reassign' => $denyType
                        ];
                    }
                }
        
                return response()->json([
                    'assignHistory' => $rows,
                    'denyReassignHistory' => $denyReassignHistory,
                ]);
            }
        
            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }
        

        function saveReviewData(Request $request) {

            if ($request->expectsJson()) 
            {
               
                $job_id = $request->input('job_id');
                $admin_id = $request->input('admin_id', 0);
                $review_type = $request->input('review_type',0);
                $positive_review = $request->input('possitive_com', NULL);
                $negative_review = $request->input('negative_com', NULL);
                $overall_review = $request->input('overall_exp', 0);
                $task_create = $request->input('task_create', 0);


                // Insert into the bcic_review table
                $bcicReview = DB::table('bcic_review')->insert([
                    'job_id' => $job_id,
                    'job_type' => 3,
                    'review_date' => Carbon::now()->format('Y-m-d'),
                    'positive_comment' => $positive_review,
                    'negative_comment' => $negative_review,
                    'overall_experience' => $overall_review,
                    'admin_id' => Session::get('id'),
                    'review_type' => $review_type,
                    'create_task' => $task_create,
                    'review_login_id' => $admin_id
                ]);

                $productList = DB::table('bcic_review')->where('job_id',$job_id)->where('is_delete', 1)->orderBy('id','DESC')->get();

                return response()->json(['success' => true,'productList'=>$productList, 'message' => 'Review Added Successfully'], 200);

            }

            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }

        function GetReviewData(Request $request) {

            if ($request->expectsJson()) 
            {
               
                $job_id = $request->input('job_id');
                $productList = DB::table('bcic_review')->where('job_id',$job_id)->where('is_delete', 1)->orderBy('id','DESC')->get();
                return response()->json(['success' => true,'productList'=>$productList, 'message' => 'get review Successfully'], 200);

            }

            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }


         function getCallList(request $request) 
         {
            if ($request->expectsJson()) 
            {
               
                // dd($request->all());

                    $job_id = $request->input('job_id');
                    $quoteid = $request->input('quote_id');

                    $callslist = DB::table('c3cx_calls')->where(function($query) use ($job_id, $quoteid) {
                        $query->where('job_id', $job_id)
                            ->orWhere('quote_id', $quoteid);
                    })
                    ->orderBy('id', 'desc') // Order by id descending
                    ->get(); // Execute the query and get the results
             return response()->json(['success' => true,'callslist'=>$callslist, 'message' => 'get call list Successfully']);
            }

            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
         }

         public function editFieldUpdate(Request $request) 
         {
             if ($request->expectsJson()) 
             {
                 // dump($request->all());

                 $value = $request->input('value');
                 $fieldtable = (!empty($request->input('fieldtable'))) ? explode('.', $request->input('fieldtable')) : [];
                 $tableid = $request->input('tid');
                 $job_id = (!empty($request->input('job_id'))) ? $request->input('job_id') : 0;
         
                 $table = $fieldtable[0] ?? '';
                 $fieldName = $fieldtable[1] ?? '';
                 $bool = 0;
         
                 if ($value != '' && !empty($tableid)) 
                 { 
                     // Array of valid fields for job_details
                     $validFields = [
                         'real_estate_agency_name',
                         'agent_name',
                         'agent_number',
                         'agent_email',
                         'agent_landline_num',
                         'agent_address',
                     ];
         
                     // Check if the fieldName is in the validFields array
                     if (in_array($fieldName, $validFields) && $table == 'job_details') 
                     {
                         $bool = DB::table($table)->where('job_id', $job_id)->update([$fieldName => $value]);
                     } 
                     else 
                     {
                         $bool = DB::table($table)->where('id', $tableid)->update([$fieldName => $value]);
                     }
                }
         
                 return response()->json([
                     'message' => (($bool) ? 'field updated successfully' : 'not updated'),
                     'success' => ($bool) ? true : false
                 ], 200);
             }
         
             return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
          }

       

      

    }