<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use App\Models\TempQuote;
use App\Models\TempDetails;
use App\Models\JobDetail;
use App\Models\TaskManager;
use App\Models\SalesTaskTrack;
use App\Models\User;
use App\Models\Jobs;
use App\Models\JobNotes;
use App\Models\QuoteNew;
use App\Models\StaffApplication;
use App\Models\Staff;
use App\Models\StaffJobsStatus;
use App\Models\ReasonForDeny;


class MasterController extends Controller
{
        function get_rs_value($table , $field, $id){
              $getData = DB::table($table)->select($field)->where('id',$id)->first();
               return  (!empty($getData->$field)) ? $getData->$field : '';
        }


        function create_quote_desc_str($r){
	  
                $desc = "";
                if($r['job_type_id']=="1"){ 
                
                          if($r['bed']>0){ $desc.=' '.$r['bed'].' Beds,'; }
                          if($r['study']>0){ $desc.=' '.$r['study'].' Study,'; }
                          if($r['bath']>0){ $desc.=' '.$r['bath'].' Bath,'; }
                          if($r['toilet']>0){ $desc.=' '.$r['toilet'].' Toilet,'; }
                          if($r['living']>0){ $desc.=' '.$r['living'].' Living Areas,'; }
                          if($r['furnished']=="Yes"){ $desc.=' Furnished ,'; }
                          if($r['property_type'] != ""){ $desc.= ' '.$r['property_type'].',' ; }
                          
                           if($r['blinds_numbers'] != '' && $r['blinds_numbers'] != 0) {
                                  $blinds_numbers = $r['blinds_numbers'];
                          }else{
                                  $blinds_numbers = '';
                          } 
                          
                          if($r['blinds_type'] !=""){ $desc.= $blinds_numbers.' '.ucwords(str_replace("_"," ",$r['blinds_type'])).' , '; }
                          
                          if($r['cleaning_wall_wash'] == 1){ $desc.=  ' 	Wall wash service is quoted on the day of the job.  This is added to the quote, but the charges will be discussed on the day of the job. '; }
                         if($r['cleaning_wall_wash'] == 2){ $desc.=  ' 	This quote is for spot cleaning of walls. No wall wash shall be included in this. '; }
                          
                          $desc.= ' Included (1 Balcony, 1 Oven,  Wall Spot Clean), Excluded (Grout, Mould, Ceiling, Garage Walls) ';
                          
                }else if ($r['job_type_id']=="2"){
                    
                     $checkproprty = array('1'=>'Yes','2'=>'No');
                     $islift = array('1'=>'Ground Floor','2'=>'1st Floor','3'=>'2nd Floor', '4'=>'Above');
                    
                         if($r['bed']>0){ $desc.=' '.$r['bed'].' Beds,'; }
                         if($r['living']>0){ $desc.=' '.$r['living'].' Living Areas,'; }
                         if($r['carpet_stairs']>0){ $desc.= $r['carpet_stairs'].' stairs , '; }
                         
                         if($r['quote_floor']>0){ $desc.= $islift[$r['quote_floor']].', '; }
                         if($r['lift_property']>0){ $desc.= ' Lift ' .$checkproprty[$r['lift_property']].' ,'; }
                         if($r['stains']>0){ $desc.=  ' stains '.$checkproprty[$r['stains']]; }
                         if($r['carpet_stain_removal'] == 1){ $desc.=  ' Add to quote: Stain Removal service is quoted on the day of the job.  This is added to the quote, but the charges will be discussed on the day of the job '; }
                         if($r['carpet_stain_removal'] == 2){ $desc.=  ' Carpet Steam clean service without Stain removal will be attended. '; }
                
                }else if ($r['job_type_id']=="3"){
                         if($r['pest_inside']>0){ $desc.=' Inside'; }
                         if($r['pest_outside']>0){ $desc.=' Outside'; }
                         if($r['pest_flee']>0){ $desc.= ' & Flea and Tick '; }			
                }else if ($r['job_type_id']=="5"){
                         if($r['stains']>0){ $desc.=  ' stains '.$checkproprty[$r['stains']].' ,'; }
                         if($r['description'] != '') { $desc.= $r['description']; }
                         if($r['carpet_stain_removal'] == 1){ $desc.=  ' Add to quote: Stain Removal service is quoted on the day of the job.  This is added to the quote, but the charges will be discussed on the day of the job '; }
                         if($r['carpet_stain_removal'] == 2){ $desc.=  ' Upholster  Steam clean service without Stain removal will be attended. '; }
                         
                         
                }elseif($r['job_type_id']=="11"){ 
                          if($r['bed']>0){ $desc.=' '.$r['bed'].' Beds,'; }
                          if($r['study']>0){ $desc.=' '.$r['study'].' Study,'; }
                          if($r['lounge_hall']>0){ $desc.=' '.$r['lounge_hall'].' Living Areas,'; }
                          if($r['kitchen']>0){ $desc.=' '.$r['kitchen'].' kitchen,'; }
                          if($r['dining_room']>0){ $desc.=' '.$r['dining_room'].' Dining room,'; }
                          if($r['office'] >0){ $desc.=' '.$r['office'].' Office ,'; }
                          if($r['garage'] >0){ $desc.= ' '.$r['garage'].' Garage,' ; }
                          if($r['laundry'] >0){ $desc.= ' '.$r['laundry'].' Laundry,' ; }
                          if($r['stairs'] >0){ $desc.= ' '.$r['stairs'].' stairs,' ; }
                          if($r['removal_inventory'] != ''){ $desc.= ' '.$r['removal_inventory'].'.'; }
                          if($r['removal_desc'] != ''){ $desc.= ' '.$r['removal_desc'].' ,' ; }
                          
                          $desc.= ' Quoted for 3 hours - 2 Men and a Truck. Stair Charges are $30 per flight not charged in this quote. Call out charges are $100 applicable on each booking. Any additional hour shall be quoted at $150/hr.  ';
                          
                }	
                
                return $desc;
        }


        function create_quote_str($temp_quote_id){
    
                $tempDetailsDataInfo =  TempDetails::where('temp_quote_id', $temp_quote_id)->where('status', 0)->orderBy('job_type_id', 'ASC')->get();
               // Log::info('tempDetailsDataInfo' , $tempDetailsDataInfo);
                $tempDetailsData = (!empty($tempDetailsDataInfo)) ? $tempDetailsDataInfo : [];

                $totalAmount = collect($tempDetailsData)
                        ->map(function ($item) {
                                // Ensure the amount is treated as a number
                                return is_numeric($item['amount']) ? $item['amount'] : 0;
                        })
                        ->sum();
                TempQuote::where('id', $temp_quote_id)->update(['amount'=>$totalAmount]);	
                return  ['tempdetails' => $tempDetailsData, 'totalAmount'=>$totalAmount];
        }


        function createTaskTrack($dataInfo){
                
                if (date('i') <= '30') {

                   $schedule_from = date('H') . ':00';
                   $schedule_to = date('H') . ':30';

                } else {
                   $schedule_from = date('H') . ':30';
                   $schedule_to = date('H', strtotime('+1 hour')) . ':00';
                }
                
                $fallow_time = $schedule_from . '-' . $schedule_to;
                $fallow_date = date('Y-m-d H:i:s');


                $job_id = (!empty($dataInfo['job_id'])) ? $dataInfo['job_id'] :  0;
                $quote_id = (!empty($dataInfo['quote_id'])) ? $dataInfo['quote_id'] :  0;
                $site_id = (!empty($dataInfo['site_id'])) ? $dataInfo['site_id'] :  0;
                $heading = (!empty($dataInfo['heading'])) ? $dataInfo['heading'] :  '';
                $comment = (!empty($dataInfo['comment'])) ? $dataInfo['comment'] :  '';

                $adminid = Session::get('id');
                $adminname = Session::get('name');

                
                $sid1 = SalesTaskTrack::insertGetId([
                        'quote_id' => $quote_id,
                        'job_id' => $job_id,
                        'task_status' => 1,
                        'heading' => $heading,
                        'comment' => $comment,
                        'staff_name' => $adminname,
                        'admin_id' => $adminid,
                        'site_id' => $site_id,
                        'status' => 1,
                        'fallow_date' => $fallow_date,
                        'fallow_time' => $fallow_time,
                        'task_assign_type' => 1,
                        'fallow_created_date' => date('Y-m-d'),
                        'task_manage_id' => $adminid,
                        'task_type' => (!empty($dataInfo['task_type'])) ? $dataInfo['task_type'] : 0,
                        'track_type' => (!empty($dataInfo['track_type'])) ? $dataInfo['track_type'] : 0,
                        'createOn' => date('Y-m-d H:i:s'),
                ]);

                $tasksid1 = TaskManager::insertGetId([
                        'completed_date' => date('Y-m-d H:i:s'),
                        'admin_id' => $adminid,
                        'job_id' => 0,
                        'task_type' => '1',
                        'quote_id' => $quote_id,
                        'job_id' => $job_id,
                        'response_type' => '0',
                        'created_date' => date('Y-m-d H:i:s'),
                        'status' => '0',
                ]);

                if ($tasksid1) {
                        SalesTaskTrack::where('id', $sid1)->update(['task_manager_id' => $tasksid1]);
                }
        }

        
       

        function GetAdmin() {
                // Step 1: Define a unique cache key
                $cacheKey = 'admin_data';
             
                // Step 2: Retrieve cached data or query the database  for 1 HR
               // $admindata = Cache::remember($cacheKey, 60 * 60, function () {
                    $admindata  =  User::select('id', 'name','login_status', 'loggedin', 'email', 'phone', 'username','auto_role')
                        ->where('status', 1)
                        ->where('is_call_allow', 1)
                        ->orderBy('name', 'ASC')
                        ->get();
                //});
            
                // dd($admindata);
                // Step 3: Return the admin data
                return $admindata;
        }
        

     

        function getPaymentStatus($jobPayment, $jobDetailsAmount)
        {
                if ($jobPayment == 0) {
                return "(Not Paid)";
                } elseif ($jobPayment < $jobDetailsAmount) {
                return "(Semi Paid)";
                } else {
                return "(Paid)";
                }
        }

        // Function to convert a custom date string to a Carbon instance
        function parseCustomDate($dateStr) {
                // Remove ordinal suffixes (st, nd, rd, th)
                $cleanedDateStr = preg_replace('/\b(?:st|nd|rd|th)\b/', '', $dateStr);
                // Parse the cleaned date string into a Carbon instance
                return Carbon::createFromFormat('j M Y', $cleanedDateStr);
        }

        function checkDoublePhoneNumber($date) {
                // Fetch phones with more than one occurrence on the given date
                $phones = QuoteNew::select('phone')
                    ->where('date', $date)
                    ->groupBy('phone')
                    ->havingRaw('COUNT(phone) > 1')
                    ->pluck('phone')
                    ->toArray();
                
                // Fetch emails with more than one occurrence on the given date
                $emails = QuoteNew::select('email')
                    ->where('booking_date', $date)
                    ->groupBy('email')
                    ->havingRaw('COUNT(email) > 1')
                    ->pluck('email')
                    ->toArray();
                
                // Merge phone and email arrays
                $arr = array_merge($phones, $emails);
                
                return $arr;
        }

        function addAdminFaultNotes($quoteId, $jobId, $faultAdminId, $heading, $comment)
        {
            // Get the current date and time
            $customDate = now();
        
            // Get the currently authenticated user's name and ID
            $admin = Auth::user();
            $staffName = $admin->name;
            $adminId = $admin->id;
        
            // Insert data into the `admin_fault` table
            DB::table('admin_fault')->insert([
                'job_id' => $jobId,
                'date' => $customDate,
                'quote_id' => $quoteId,
                'fault_admin_id' => $faultAdminId,
                'heading' => $heading,
                'comment' => $comment,
                'login_id' => $adminId,
                'staff_name' => $staffName
            ]);
        }


        public function salesTask($adminid, $search_type, $search_value ,$salesid = 0)
        {
                $today = Carbon::today()->format('Y-m-d');

                $Qustatus = dd_value(31);

                // Build the initial query
                $query = DB::table('sales_task_track')->select('id','quote_id','heading','comment', 'ans_date','left_sms_date', 'job_id', 'app_id','fallow_date' ,'fallow_time','fallow_created_date','task_manage_id')
                        ->where('task_status', 1)
                        ->where('track_type', 1);

                // Apply admin ID filter only if needed
                if ($adminid !== 'all') {
                        $query->where('task_manage_id', $adminid);
                }

                if($salesid > 0) {
                        $query->where('id', $salesid);
                }

                // Apply search type filter only if needed
                if (!empty($search_type)) {
                        $searchFields = [1 => 'quote_id', 2 => 'job_id', 3 => 'app_id'];
                        if (isset($searchFields[$search_type])) {
                          $query->where($searchFields[$search_type], $search_value);
                        }
                }

                // Use a single query to get IDs matching the subquery criteria
                $validQuoteIds = QuoteNew::where(function ($query) use ($today) {
                        $query->where('booking_date', '>=', $today)
                                ->orWhere('booking_date', '0000-00-00');
                        })
                        ->where('removal_enquiry_date', '00:00:00 00:00:00')
                        ->where('booking_id', 0)
                        ->whereNotIn('step', [8, 9, 10])
                        ->where('denied_id', 0)
                        ->pluck('id');

                // Apply the filtered quote IDs to the main query
                $query->whereIn('quote_id', $validQuoteIds)
                        ->orderBy('fallow_date', 'DESC')
                        ->get();
                        //->Limit(10);

                // Fetch and process data in one go
                $getSales = $query->get()->map(function ($data) use ($Qustatus) {
                        $quoteInfo = QuoteNew::select('name','id','login_id', 'booking_id', 'amount', 'step', 'address', 'job_ref','email', 'phone','site_id','booking_date', 'date')
                        ->find($data->quote_id);

                        if (!$quoteInfo) return null; 

                       // $siteID = $quoteInfo->site_id;
                       // $siteInfo = DB::table('sites')->select('abv','name')->find($siteID);

                        $jobdate = $quoteInfo->booking_date !== '0000-00-00'
                        ?  date('dS M Y', strtotime($quoteInfo->booking_date))
                        : '';

                        $quotedate = date('dS M Y', strtotime($quoteInfo->date));

                        $quoteDetailsTable = $quoteInfo->booking_id == 0 ? 'quote_details' : 'job_details';

                        // Fetch job types and icons in a single query
                        $jobTypes = DB::table($quoteDetailsTable)
                        ->join('job_type', 'job_type.id', '=', "{$quoteDetailsTable}.job_type_id")
                        ->where("{$quoteDetailsTable}.status", '!=', 2)
                        ->where("{$quoteDetailsTable}.quote_id", $quoteInfo->id)
                        ->select('job_type.job_icon', 'job_type.name')
                        ->get();

                        $getData = [];
                                if (!empty($jobTypes)) {
                                        foreach ($jobTypes as $item) {
                                                $getData[] = [
                                                'icon' => $item->job_icon,
                                                'job_type' => $item->name
                                                ];
                                        }
                                }
                                

                        return array_merge((array)$data, [
                                'Pagetype' => 'Sales',
                                'pageid' => '1',
                                'name' => $quoteInfo->name,
                                'job_ref' => $quoteInfo->job_ref,
                                'address' => $quoteInfo->address,
                                'email' => $quoteInfo->email,
                                'phone' => $quoteInfo->phone,
                                'login_id' => $quoteInfo->login_id,
                                'site_id'=> $quoteInfo->site_id,
                                'jobdate' => $jobdate,
                                'quotedate' => $quotedate,
                                'imgstr' => $getData,
                                'status' => $Qustatus,
                                'step' => $quoteInfo->step,
                                'amount' => (!empty($quoteInfo->amount)) ? (float) $quoteInfo->amount : 0,
                               // 'site_name' => $siteInfo->abv ?? '',
                                
                            ]);
                        })->filter()->toArray();

               return $getSales;
        }

        public function HRTask($adminid, $search_type, $search_value , $salesid = 0)
        {
                // Build the base query
                $query = DB::table('sales_task_track')
                        ->select('id', 'quote_id', 'heading', 'comment', 
                        'job_id', 'app_id', 'fallow_date','ans_date','left_sms_date', 'fallow_time', 'fallow_created_date', 'ans_date','left_sms_date', 'task_manage_id')
                        ->where('task_status', 1)
                        ->where('track_type', 5);

                if ($adminid !== 'all') {
                        $query->where('task_manage_id', $adminid);
                }
                if($salesid > 0) {
                        $query->where('id', $salesid);
                }

                if ($search_type == 1) {
                        $query->where('quote_id', $search_value);
                } elseif ($search_type == 2) {
                        $query->where('job_id', $search_value);
                } elseif ($search_type == 3) {
                        $query->where('app_id', $search_value);
                }

                // if (!empty($search_type)) {
                //         $searchFields = [1 => 'quote_id', 2 => 'job_id', 3 => 'app_id'];
                //         if (isset($searchFields[$search_type])) {
                //           $query->where($searchFields[$search_type], $search_value);
                //         }
                // }

                // Retrieve filtered IDs in one query
                $filteredIds = StaffApplication::select('id')
                        ->where('staff_is_added', 0)
                        ->whereNotIn('step_status', [5, 9, 6])
                        ->where('denied_id', 0)
                        ->whereNotIn('sutab_unsutab', [4, 5])
                        ->pluck('id');

                // Retrieve tasks for filtered IDs
                $tasks = $query->whereIn('app_id', $filteredIds)
                        ->orderBy('fallow_date', 'DESC')
                        ->get();

                // Retrieve all necessary staff application data in one query
                $staffApplications = StaffApplication::select([
                        'id', 'first_name', 'email', 'site_id', 'first_call', 'job_types',
                        'first_call_date', 'sutab_unsutab', 'mobile as phone', 'address', 'admin_id',
                        'step_status', 'date_started'
                        ])
                        ->whereIn('id', $filteredIds)
                        ->get()
                        ->keyBy('id');

                // Retrieve all job types and their icons in one query
                $jobTypes = $staffApplications->pluck('job_types')->flatten()->unique();

                $jobTypeNames = $jobTypes->map(function ($jobType) {
                        return explode(',', str_replace('_', ' ', ucwords(str_replace('services_', '', $jobType))));
                })->flatten()->unique();

                $jobIcons = DB::table('job_type')
                        ->whereIn('name', $jobTypeNames)
                        ->pluck('job_icon', 'name');

                    //  dd($jobIcons);  

                // Process tasks and enrich with additional data
                $result = $tasks->map(function ($task) use ($staffApplications, $jobIcons) {
                        $staffApplication = $staffApplications->get($task->app_id);

                        $classstyle = '';
                        if ($staffApplication && $staffApplication->step_status == 6) {
                        $classstyle = 'background: #e5bfc5;';
                        }

                        $jobTypes = ucwords(str_replace('services_', '', $staffApplication->job_types));
                        $jobTypeNames = explode(',', str_replace('_', '', $jobTypes));

                        if (!empty($jobIcons)) {
                        // Map job icons
                                $task->imgstr = collect($jobTypeNames)->mapWithKeys(function ($type) use ($jobIcons) {
                                        return [$type => $jobIcons[$type] ?? null];
                                });
                        } else {
                               $task->imgstr = null; // Or an empty array [] if preferred
                        }
                        

                        $task->Pagetype = 'HR';
                        $task->pageid = '3';
                        $task->ans_date = ($task->ans_date != '0000-00-00 00:00:00') ? date('dS M  H:i', strtotime($task->ans_date)) : '';
                        $task->left_sms_date = ($task->left_sms_date != '0000-00-00 00:00:00') ? date('dS M  H:i', strtotime($task->left_sms_date)) : '';

                        return array_merge((array) $task, [
                        'classstyle' => $classstyle,
                        'first_name' => $staffApplication->first_name ?? '',
                        'email' => $staffApplication->email ?? '',
                        'login_id' => $staffApplication->admin_id ?? 0,
                        'site_id' => $staffApplication->site_id ?? '',
                        'job_types' => $staffApplication->job_types ?? '',
                        'first_call' => $staffApplication->first_call ?? '',
                        'date_started' => $staffApplication->date_started ?? '',
                        'first_call_date' => $staffApplication->first_call_date ?? '',
                        'sutab_unsutab' => $staffApplication->sutab_unsutab ?? 0,  
                        'phone' => $staffApplication->phone ?? '',
                        'address' => $staffApplication->address ?? '',
                        'step_status' => $staffApplication->step_status ?? '',
                        ]);
                })->toArray();

                return $result;
        }

        public function ReviewTask($adminid, $search_type, $search_value, $salesid = 0)
        {
                // Build the initial query 
                $query = DB::table('sales_task_track')
                        ->select(
                                'id', 'quote_id', 'heading', 'ans_date', 'left_sms_date', 'comment', 'voucher_email', 
                                'feedback_email', 'first_email', 'second_email', 'threed_email', 'job_id', 'app_id', 
                                'fallow_date', 'fallow_time', 'fallow_created_date', 'task_manage_id'
                        )
                        ->where('task_status', 1)
                        ->where('track_type', 6)
                        ->whereDate('createOn', '>', date('Y-m-d', strtotime('-3 month')))
                        ->whereDate('createOn', '<', date('Y-m-d'));

                // Apply adminid condition
                if ($adminid !== 'all') {
                        $query->where('task_manage_id', $adminid);
                }
                
                if($salesid > 0) {
                        $query->where('id', $salesid);
                }
                // Apply search type condition
                if ($search_type == 1) {
                        $query->where('quote_id', $search_value);
                } elseif ($search_type == 2) {
                        $query->where('job_id', $search_value);
                } elseif ($search_type == 3) {
                        $query->where('app_id', $search_value);
                }

                // Add job_id subquery and exclusions
                $query->whereIn('job_id', function ($subQuery) {
                        $subQuery->select('id')
                        ->from('jobs')
                        ->whereIn('status', [1, 3]);
                })
                ->whereNotIn('job_id', function ($subQuery) {
                        $subQuery->select('job_id')
                        ->from('job_complaint');
                })
                ->whereNotIn('job_id', function ($subQuery) {
                        $subQuery->select('job_id')
                        ->from('job_reclean');
                })
                ->whereNotIn('job_id', function ($subQuery) {
                        $subQuery->select('job_id')
                        ->from('bcic_review');
                })
                ->orderBy('fallow_date', 'DESC')
                ->get();
                //->Limit(30);

                // Execute the query and process the results
                $reviewtask = $query->get()->map(function ($data) {
                        $quoteInfo = QuoteNew::select('id', 'review_status')
                        ->where('id', $data->quote_id)
                        ->first();

                        $data->review_status = $quoteInfo->review_status ?? null;
                        $data->Pagetype = 'Review';
                        $data->pageid = '4';

                        $quoteInfo = QuoteNew::select('name','id', 'login_id', 'booking_id', 'amount' ,'job_ref','email', 'phone','site_id','booking_date', 'date')
                        ->where('booking_id', $data->job_id)->first();

                        if (!$quoteInfo) return null; 

                        $jobdate = $quoteInfo->booking_date !== '0000-00-00'
                        ?  date('dS M Y', strtotime($quoteInfo->booking_date))
                        : '';
                        $quotedate = date('dS M Y', strtotime($quoteInfo->date));

                        $quoteDetailsTable =   'job_details';

                        // Fetch job types and icons in a single query
                        $jobTypes = DB::table($quoteDetailsTable)
                        ->join('job_type', 'job_type.id', '=', "{$quoteDetailsTable}.job_type_id")
                        ->where("{$quoteDetailsTable}.status", '!=', 2)
                        ->where("{$quoteDetailsTable}.quote_id", $quoteInfo->id)
                        ->select('job_type.job_icon', 'job_type.name')
                        ->get();

                        $getData = [];
                                if (!empty($jobTypes)) {
                                        foreach ($jobTypes as $item) {
                                                $getData[] = [
                                                'icon' => $item->job_icon,
                                                'job_type' => $item->name
                                                ];
                                        }
                                }
                      
                        return array_merge((array)$data, [
                                'name' => $quoteInfo->name,
                                'job_ref' => $quoteInfo->job_ref,
                                'email' => $quoteInfo->email,
                                'phone' => $quoteInfo->phone,
                                'site_id'=> $quoteInfo->site_id,
                                'login_id'=> $quoteInfo->login_id,
                                'jobdate' => $jobdate,
                                'quotedate' => $quotedate,
                                'imgstr' => $getData,
                                'amount' => (!empty($quoteInfo->amount)) ? (float) $quoteInfo->amount : 0,
                                'reclean_status' =>  (!empty($reclean_status)) ? @$recleanTaskStatus[$reclean_status] : '',
                                //'infoName' => $infoName, // Include the staff info name
                                
                         ]);

                })->toArray(); 

                return (!empty($reviewtask)) ? $reviewtask : [];
        }

        public function recleanTask($adminid, $search_type, $search_value , $salesid = 0) 
        {
                $recleanTaskStatus = dd_value(158);
                $statusdd =   dd_value(135);
                $query = DB::table('sales_task_track')->select('id', 'quote_id', 'heading','ans_date','left_sms_date','first_email','second_email','threed_email', 'staff_id', 'comment', 'job_id','is_task_status', 'app_id', 'fallow_date', 'fallow_time', 'fallow_created_date', 'ans_date','left_sms_date', 'task_manage_id')
                ->where('task_status', 1)->where('track_type', 7);

                if ($adminid !== 'all' && $adminid > 0) {
                        $query->where('task_manage_id', $adminid);
                }

                if($salesid > 0) {
                     $query->where('id', $salesid);
                }

                if ($search_type == 1) {
                        $query->where('quote_id', $search_value);
                } elseif ($search_type == 2) {
                        $query->where('job_id', $search_value);
                } elseif ($search_type == 3) {
                        $query->where('app_id', $search_value);
                }

                $query->where('is_task_status', '!=', 3)
                        ->whereIn('job_id', function ($subQuery) {
                        $subQuery->select('id')
                                ->from('jobs')
                                ->where('status', 5);
                        })
                        ->orderBy('fallow_date', 'DESC');

                   //  print_r($query->get());   

                $tasks = $query->get()->map(function ($data) use ($recleanTaskStatus, $statusdd) {
                        $data->Pagetype = 'Reclean';
                        $data->pageid = 6;
                        	

                        $quoteInfo = QuoteNew::select('name','id', 'booking_id', 'amount', 'job_ref','email', 'phone','site_id','booking_date', 'date')
                        ->where('booking_id', $data->job_id)->first();

                        if (!$quoteInfo) return null; 
                        $reclean_status = 0;
                        $reclean_status =  get_rs_value('jobs','reclean_status',$quoteInfo->booking_id);


                        $quoteDetailsTable =  'job_reclean'; //$quoteInfo->booking_id == 0 ? 'quote_details' : 'job_details';

                        // Fetch job types and icons in a single query
                        $jobTypes = DB::table($quoteDetailsTable)
                        ->join('job_type', 'job_type.id', '=', "{$quoteDetailsTable}.job_type_id")
                        ->where("{$quoteDetailsTable}.status", '!=', 2)
                        ->where("{$quoteDetailsTable}.quote_id", $quoteInfo->id)
                        ->select('job_type.job_icon', 'job_type.name','job_reclean.reclean_status','job_reclean.reclean_work')
                        ->get();

                        $getData = [];
                                if (!empty($jobTypes)) {
                                        foreach ($jobTypes as $item) {
                                                $getData[] = [
                                                'icon' => $item->job_icon,
                                                'job_type' => $item->name
                                                ];
                                        }
                                }
                        $infoName = '';

                        $jobdate = $quoteInfo->booking_date !== '0000-00-00'
                        ?  date('dS M Y', strtotime($quoteInfo->booking_date))
                        : '';

                        $quotedate = date('dS M Y', strtotime($quoteInfo->date));


                        if ($data->staff_id > 0) {
                                $staffInfo = DB::table('staff')
                                ->select('id', 'name', 'site_id', 'email', 'mobile')
                                ->where('id', $data->staff_id)
                                ->first();
                
                                if ($staffInfo) {
                                        $infoName = $staffInfo->name . '( StaffID#' . $staffInfo->id . ')';
                                }
                        }    

                        return array_merge((array)$data, [
                                'name' => $quoteInfo->name,
                                'job_ref' => $quoteInfo->job_ref,
                                'email' => $quoteInfo->email,
                                'phone' => $quoteInfo->phone,
                                'site_id'=> $quoteInfo->site_id,
                                'jobdate' => $jobdate,
                                'statusdd' =>$statusdd,
                                'quotedate' => $quotedate,
                                'imgstr' => $getData,
                                'amount' => (!empty($quoteInfo->amount)) ? (float) $quoteInfo->amount : 0,
                                'reclean_status' =>  (!empty($reclean_status)) ? @$recleanTaskStatus[$reclean_status] : '',
                                'infoName' => $infoName, // Include the staff info name
                                
                            ]);
                        })->filter()->toArray();

                
                return (!empty($tasks)) ? $tasks : [];
        }


        public function unassignTask($adminid, $search_type, $search_value , $salesid = 0)
        {
                $recleanTaskStatus = dd_value(158);
                $statusdd =   dd_value(135);
                $query = DB::table('sales_task_track')
                        ->select('id','quote_id','heading','ans_date','left_sms_date','comment','is_task_status','staff_id', 'job_id', 'app_id','fallow_date' ,'fallow_time','fallow_created_date','task_manage_id')
                        ->where('task_status', 1)
                        ->where('track_type', 8);

                if ($adminid !== 'all' && $adminid > 0) {
                        $query->where('task_manage_id', $adminid);
                }

                if($salesid > 0) {
                   $query->where('id', $salesid);
                }

                if ($search_type == 1) {
                        $query->where('quote_id', $search_value);
                } elseif ($search_type == 2) {
                        $query->where('job_id', $search_value);
                } elseif ($search_type == 3) {
                        $query->where('app_id', $search_value);
                }

                $query->where('is_task_status', '!=', 3)
                        ->where('noti_type', '!=', 1)
                        ->orderBy('fallow_date', 'DESC');

                $tasks = $query->get()->map(function ($data) use ($recleanTaskStatus ,$statusdd) {
                        $data->Pagetype = 'Un-assign';
                        $data->pageid = 7;
                       
                        
                        $quoteInfo = QuoteNew::select('name','id', 'booking_id', 'amount', 'job_ref','email', 'phone','site_id','booking_date', 'date')
                        ->where('booking_id', $data->job_id)->first();

                        if (!$quoteInfo) return null; 
                        $reclean_status = 0;
                        $reclean_status =  get_rs_value('jobs','reclean_status',$quoteInfo->booking_id);


                        $quoteDetailsTable =  $quoteInfo->booking_id == 0 ? 'quote_details' : 'job_details';

                        // Fetch job types and icons in a single query
                        $jobTypes = DB::table($quoteDetailsTable)
                        ->join('job_type', 'job_type.id', '=', "{$quoteDetailsTable}.job_type_id")
                        ->where("{$quoteDetailsTable}.status", '!=', 2)
                        ->where("{$quoteDetailsTable}.quote_id", $quoteInfo->id)
                        ->select('job_type.job_icon', 'job_type.name')
                        ->get();

                        $getData = [];
                                if (!empty($jobTypes)) {
                                        foreach ($jobTypes as $item) {
                                                $getData[] = [
                                                'icon' => $item->job_icon,
                                                'job_type' => $item->name
                                                ];
                                        }
                                }
                        $infoName = '';

                        $jobdate = $quoteInfo->booking_date !== '0000-00-00'
                        ?  date('dS M Y', strtotime($quoteInfo->booking_date))
                        : '';

                        $quotedate = date('dS M Y', strtotime($quoteInfo->date));


                        if ($data->staff_id > 0) {
                                $staffInfo = DB::table('staff')
                                ->select('id', 'name', 'site_id', 'email', 'mobile')
                                ->where('id', $data->staff_id)
                                ->first();
                
                                if ($staffInfo) {
                                        $infoName = $staffInfo->name . '( StaffID#' . $staffInfo->id . ')';
                                }
                        }    

                        return array_merge((array)$data, [
                                'name' => $quoteInfo->name,
                                'job_ref' => $quoteInfo->job_ref,
                                'email' => $quoteInfo->email,
                                'phone' => $quoteInfo->phone,
                                'site_id'=> $quoteInfo->site_id,
                                'jobdate' => $jobdate,
                                'statusdd' =>$statusdd,
                                'quotedate' => $quotedate,
                                'imgstr' => $getData,
                                'amount' => (!empty($quoteInfo->amount)) ? (float) $quoteInfo->amount : 0,
                                'reclean_status' =>  (!empty($reclean_status)) ? @$recleanTaskStatus[$reclean_status] : '',
                                'infoName' => $infoName, // Include the staff info name
                                
                            ]);
                        })->filter()->toArray();

                return (!empty($tasks)) ? $tasks : [];
        }

        public function otdTask($adminid, $search_type, $search_value , $salesid = 0)
        {
                $recleanTaskStatus = dd_value(158);
                $statusdd =   dd_value(135);
                $query = DB::table('sales_task_track')->select('id','quote_id','heading','comment','ans_date','left_sms_date','staff_id','is_task_status', 'job_id', 'app_id','fallow_date' ,'fallow_time','fallow_created_date','task_manage_id')      
                ->where('task_status', 1)
                ->where('track_type', 9);

                if ($adminid !== 'all' && $adminid > 0) {
                        $query->where('task_manage_id', $adminid);
                }

                if($salesid > 0) {
                    $query->where('id', $salesid);
                }

                if ($search_type == 1) {
                        $query->where('quote_id', $search_value);
                } elseif ($search_type == 2) {
                        $query->where('job_id', $search_value);
                } elseif ($search_type == 3) {
                        $query->where('app_id', $search_value);
                }


                if (!empty($priority) && $priority > 0) {
                        $query->where('priority', $priority);
                }
               $query->where('is_task_status', '!=' ,3);
               $query->where('noti_type', '!=' ,1);
               
                if (!empty($isLate) && $isLate == 2) {
                        $query->where('is_task_status', 1)
                        ->where('next_update_time', '<=', now())
                        ->where('next_update_time', '!=', '0000-00-00 00:00:00');
                }

                $query->orderBy('fallow_date', 'DESC');
                
                $tasks = $query->get()->map(function ($data) use ($recleanTaskStatus, $statusdd) {
                        $data->Pagetype = 'OTD';
                        $data->pageid = '8';
                       
                        $quoteInfo = QuoteNew::select('name','id', 'booking_id', 'amount', 'job_ref','email', 'phone','site_id','booking_date', 'date')
                        ->where('booking_id', $data->job_id)->first();

                        if (!$quoteInfo) return null; 
                        $reclean_status = 0;
                        $reclean_status =  get_rs_value('jobs','reclean_status',$quoteInfo->booking_id);


                        $quoteDetailsTable =  $quoteInfo->booking_id == 0 ? 'quote_details' : 'job_details';

                        // Fetch job types and icons in a single query
                        $jobTypes = DB::table($quoteDetailsTable)
                        ->join('job_type', 'job_type.id', '=', "{$quoteDetailsTable}.job_type_id")
                        ->where("{$quoteDetailsTable}.status", '!=', 2)
                        ->where("{$quoteDetailsTable}.quote_id", $quoteInfo->id)
                        ->select('job_type.job_icon', 'job_type.name')
                        ->get();

                        $getData = [];
                                if (!empty($jobTypes)) {
                                        foreach ($jobTypes as $item) {
                                                $getData[] = [
                                                'icon' => $item->job_icon,
                                                'job_type' => $item->name
                                                ];
                                        }
                                }
                        $infoName = '';

                        $jobdate = $quoteInfo->booking_date !== '0000-00-00'
                        ?  date('dS M Y', strtotime($quoteInfo->booking_date))
                        : '';

                        $quotedate = date('dS M Y', strtotime($quoteInfo->date));


                        if ($data->staff_id > 0) {
                                $staffInfo = DB::table('staff')
                                ->select('id', 'name', 'site_id', 'email', 'mobile')
                                ->where('id', $data->staff_id)
                                ->first();
                
                                if ($staffInfo) {
                                        $infoName = $staffInfo->name . '( StaffID#' . $staffInfo->id . ')';
                                }
                        }    

                        return array_merge((array)$data, [
                                'name' => $quoteInfo->name,
                                'job_ref' => $quoteInfo->job_ref,
                                'email' => $quoteInfo->email,
                                'phone' => $quoteInfo->phone,
                                'site_id'=> $quoteInfo->site_id,
                                'jobdate' => $jobdate,
                                'statusdd'=>$statusdd,
                                'quotedate' => $quotedate,
                                'imgstr' => $getData,
                                'amount' => (!empty($quoteInfo->amount)) ? (float) $quoteInfo->amount : 0,
                                'reclean_status' =>  (!empty($reclean_status)) ? @$recleanTaskStatus[$reclean_status] : '',
                                'infoName' => $infoName, // Include the staff info name
                                
                            ]);
                        })->filter()->toArray();

                return (!empty($tasks)) ? $tasks : [];
        }

        public function callCareTask($adminid, $search_type, $search_value, $salesid = 0)
        {
                $statusdd =   dd_value(135);

                $query = DB::table('sales_task_track')->select('id','quote_id','heading','comment','ans_date','left_sms_date','staff_id', 'is_task_status as message_status', 'job_id', 'app_id','fallow_date' ,'fallow_time','fallow_created_date','task_manage_id')      
                ->where('task_status', 1)
                ->where('track_type', 11);

                if ($adminid !== 'all' && $adminid > 0) {
                        $query->where('task_manage_id', $adminid);
                }

                if($salesid > 0) {
                        $query->where('id', $salesid);
                }

                if ($search_type == 1) {
                        $query->where('quote_id', $search_value);
                } elseif ($search_type == 2) {
                        $query->where('job_id', $search_value);
                } elseif ($search_type == 3) {
                        $query->where('app_id', $search_value);
                } elseif ($search_type == 4) {
                        $query->where('staff_id', $search_value);
                }

                $query->where('is_task_status', '!=', '3')
                        ->whereIn('care_call_id', function ($subQuery) {
                        $subQuery->select('id')
                                ->from('staff_call_care')
                                ->where('status', 1);
                        })
                        ->orderBy('fallow_date', 'DESC');
                 
                $tasks = $query->get()->map(function ($data) use ($statusdd) {
                        $data->Pagetype = 'CallCare';
                        $data->pageid = 11;
                        $data->statusdd = $statusdd;
                        $data->name = explode(' ',$data->heading)[0];

                        //explode(' ',$data['heading'])[0]
                        

                        if(!empty($data->job_id)) {
                                $statfCare = DB::table('staff_call_care')
                                ->where('booking_id', $data->job_id)->first();
                        }else{
                                $statfCare = [];
                        }
                        
                        return array_merge((array)$data, (array) $statfCare);

                })->toArray();


                 //dd($tasks);

                return (!empty($tasks)) ? $tasks : [];
        }
        

        function ComplaintTask($adminid, $search_type, $search_value, $salesid = 0) {
                $statusdd =   dd_value(135);
                $query = DB::table('sales_task_track')->select('id','quote_id','heading','comment','ans_date','left_sms_date', 'job_id', 'is_task_status as message_status', 'app_id','fallow_date' ,'fallow_time','fallow_created_date','task_manage_id') 
                ->where('task_status', 1)
                ->where('track_type', 12);
            
                if ($adminid !== 'all' && $adminid > 0) {
                    $query->where('task_manage_id', $adminid);
                }
                if($salesid > 0) {
                      $query->where('id', $salesid);
                }

                if ($search_type == 1) {
                    $query->where('quote_id', $search_value);
                } elseif ($search_type == 2) {
                    $query->where('job_id', $search_value);
                } elseif ($search_type == 3) {
                    $query->where('app_id', $search_value);
                } elseif ($search_type == 4) {
                    $query->where('staff_id', $search_value);
                }
            
                $query->where('is_task_status', '!=', 3)
                      ->orderBy('fallow_date', 'DESC');
            
                $data = $query->get();
            
                $callCareData = [];
                foreach ($data as $row) {
                    $row->Pagetype = 'Complaint';
                    $row->pageid = '12';
                    $row->statusdd = $statusdd;
                    
                    $callCareData[] = (array) $row;
                }
            
                return (!empty($callCareData)) ? $callCareData : [];
        }

        function CleanerQualityTask($adminid, $search_type, $search_value , $salesid = 0) {
                // Initialize the query
                $statusdd =   dd_value(135);
                $query = DB::table('sales_task_track')->select('id','quote_id','staff_id', 'heading', 'ans_date','left_sms_date', 'comment','is_task_status as message_status', 'job_id', 'app_id','fallow_date' ,'fallow_time','fallow_created_date','task_manage_id') 
                ->where('task_status', 1)
                ->where('track_type', 10);
            
                // Add condition based on $adminid
                if ($adminid !== 'all' && $adminid > 0) {
                    $query->where('task_manage_id', $adminid);
                }

                if($salesid > 0) {
                        $query->where('id', $salesid);
                }
            
                // Add conditions based on $search_type
                if ($search_type == 1) {
                    $query->where('quote_id', $search_value);
                } elseif ($search_type == 2) {
                    $query->where('job_id', $search_value);
                } elseif ($search_type == 3) {
                    $query->where('app_id', $search_value);
                } elseif ($search_type == 4) {
                    $query->where('staff_id', $search_value);
                }
            
                // Exclude tasks with status 3
                $query->where('is_task_status', '!=', 3)
                      ->orderBy('fallow_date', 'DESC');
            
                // Fetch the results
                $data = $query->get();
            
                // Initialize the result array
                $callCareData = [];
            
                // Add additional fields to each result
                foreach ($data as $row) {
                    $row->Pagetype = 'Cleaner-Quality';
                    $row->pageid = '10';
                    $row->statusdd = $statusdd;
                    $callCareData[] = (array) $row;
                }
            
                return (!empty($callCareData)) ? $callCareData : [];
                
        }

        function voucherData($adminid, $search_type, $search_value , $salesid = 0) {
                // Initialize the query
                $statusdd =   dd_value(135);
                $query = DB::table('sales_task_track')->select('id','quote_id','heading','comment','ans_date','left_sms_date','is_task_status as message_status', 'task_type', 'job_id', 'app_id','fallow_date' ,'fallow_time','fallow_created_date','task_manage_id') 
                ->where('task_status', 1)
                ->where('track_type', 13)
                ->where('voucher_status', 0)
                ->where('is_task_status', '!=', 3);
            
                // Add condition based on $adminid
                if ($adminid !== 'all' && $adminid > 0) {
                    $query->where('task_manage_id', $adminid);
                }
                if($salesid > 0) {
                        $query->where('id', $salesid);
                }
                // Add conditions based on $search_type
                switch ($search_type) {
                    case 1:
                        $query->where('quote_id', $search_value);
                        break;
                    case 2:
                        $query->where('job_id', $search_value);
                        break;
                    case 3:
                        $query->where('app_id', $search_value);
                        break;
                    case 4:
                        $query->where('staff_id', $search_value);
                        break;
                }
            
                // Order by fallow_date descending
                $query->orderBy('fallow_date', 'DESC');
            
            
                // Add additional fields to each result
                $voucherData = $query->get()->map(function ($data) use ($statusdd) {
                        $taskType = str_replace('Sales_Yearly_Task', 'Sales-Yearly', $data->task_type);
                        $taskType = str_replace('voucher_task', 'Voucher-Task', $taskType);
                        $data->Pagetype = $taskType;
                        $data->pageid = 13;
                        $data->statusdd = $statusdd;
                        
                        $quoteInfo = QuoteNew::select('name','id', 'booking_id', 'amount', 'job_ref','email', 'phone','site_id','booking_date', 'date')
                    ->where('id', $data->quote_id)->first();

                    //if (!$quoteInfo) return $data->quote_id; 
                    
                    $quoteInfo = (!empty($quoteInfo)) ? $quoteInfo : [];

                   
                     $jobdate = (!empty($quoteInfo->booking_date) && ($quoteInfo->booking_date !== '0000-00-00'))
                     ?  date('dS M Y', strtotime($quoteInfo->booking_date))
                     : '';
                     
                     $quotedate = (!empty($quoteInfo->date) && ($quoteInfo->date !== '0000-00-00'))
                     ?  date('dS M Y', strtotime($quoteInfo->date))
                     : '';
                      // return array_merge((array)$data, (array) $quoteInfo);

                       return array_merge((array)$data, [
                                'name' => (!empty($quoteInfo->name)) ? $quoteInfo->name : '',
                                'job_ref' => (!empty($quoteInfo->job_ref)) ? $quoteInfo->job_ref : '',
                                'email' => (!empty($quoteInfo->email)) ? $quoteInfo->email : '',
                                'phone' => (!empty($quoteInfo->phone)) ? $quoteInfo->phone : '',
                                'site_id'=> (!empty($quoteInfo->site_id)) ? $quoteInfo->site_id : '',
                                'jobdate' => $jobdate,
                                'quotedate' => $quotedate,
                                'amount' => (!empty($quoteInfo->amount)) ? (float) $quoteInfo->amount : 0,
                        ]);
                })->toArray();

                return (!empty($voucherData)) ? $voucherData : [];
        }


        function CustomTask($adminId, $searchType, $searchValue, $salesid = 0)
        {
                $roleTypeInfo = dd_value(102);
                $statusdd = dd_value(135);

                $query = DB::table('sales_task_track')->select(
                        'id', 'quote_id', 'heading', 'ans_date', 'left_sms_date', 'comment',
                        'job_id', 'app_id', 'notification_id', 'fallow_date', 'fallow_time',
                        'fallow_created_date', 'ans_date', 'left_sms_date', 'task_manage_id'
                )->where('track_type', 4);

                // Apply adminId filter
                if ($adminId !== 'all') {
                        if ($adminId > 0) {
                        $query->where('task_manage_id', $adminId);
                        }
                }

                // Apply salesid filter
                if ($salesid > 0) {
                        $query->where('id', $salesid);
                }

                // Apply search type and value filters
                switch ($searchType) {
                        case 1:
                        $query->where('quote_id', $searchValue);
                        break;
                        case 2:
                        $query->where('job_id', $searchValue);
                        break;
                        case 3:
                        $query->where('app_id', $searchValue);
                        break;
                }

                // Add notification_id filter
                $query->whereIn('notification_id', function ($subQuery) {
                        $subQuery->select('id')
                        ->from('site_notifications')
                        ->where('notifications_status', '0')
                        ->where('message_status', '!=', 3)
                        ->where('noti_type', 2)
                        ->whereIn('notifications_type', [5, 6, 7, 8]);
                });

                // Order by fallow_date
                $query->orderBy('fallow_date', 'desc');

                // Dump SQL query and bindings for debugging
               //  dump($query->toSql(), $query->getBindings());

                // Continue with data mapping
                $customeData = $query->get()->map(function ($data) use ($roleTypeInfo, $statusdd) {
                        $data->Pagetype = 'Custom';
                        $data->pageid = 5;

                        $notificationInfo = DB::table('site_notifications')
                        ->select('job_id', 'quote_id', 'app_id', 'heading as nheading', 'comment as ncomment', 'task_from', 'login_id',
                          'message_status', 'staff_id', 'priority_status', 'staff_name', 'login_id', 'role_type_id', 'task_type_noti')
                        ->find($data->notification_id);

                        $task_type_noti = ($notificationInfo->task_type_noti > 0) ? get_rs_value('role_sub_category', 'name', $notificationInfo->task_type_noti) : '';

                        $department_name = (!empty($notificationInfo->role_type_id)) ? @$roleTypeInfo[$notificationInfo->role_type_id] : '';

                        return array_merge((array)$data, [
                        'job_id' => $notificationInfo->job_id,
                        'quote_id' => $notificationInfo->quote_id,
                        'app_id' => $notificationInfo->app_id,

                        'nheading' => $notificationInfo->nheading,
                        'ncomment' => $notificationInfo->ncomment,
                        'task_from' => $notificationInfo->task_from,

                        'staff_id' => $notificationInfo->staff_id,
                        'priority_status' => $notificationInfo->priority_status,
                        'message_status' => $notificationInfo->message_status,
                        'staff_name' => $notificationInfo->staff_name, 
                        'statusdd' => $statusdd,
                        'login_id' => ($notificationInfo->login_id > 0) ? get_rs_value('admin', 'name', $notificationInfo->login_id) : 'Auto',
                        'role_type_id' => $notificationInfo->role_type_id,
                        'departmentName' => $department_name,
                        'task_type_noti' => $task_type_noti,
                        ]);
                })->filter()->toArray();

                // dd($customeData);

                return (!empty($customeData)) ? $customeData : [];
        }



        function get_app_activity($qid, $tasktype = 1, $box_type = 1)
        {
                $getRespoType = dd_value(111);
               // $qid = 466;
                $query = DB::table('task_manager')
                ->where('task_id', $qid);


                $getReco =  $query->orderBy('id', 'desc')->get();

                $getdata = [];
                if ($getReco->isNotEmpty()) {
                        foreach ($getReco as $notesVal) {
                            // Fetch admin name based on admin_id or app_id
                            if ($notesVal->admin_id > 0) {
                                $adminname = get_rs_value('admin', 'name', $notesVal->admin_id);
                            } elseif (isset($notesVal->app_id) && $notesVal->app_id > 0) {
                                $adminname = get_rs_value('staff_applications', 'admin_type', $notesVal->app_id);
                            } else {
                                $adminname = '';
                            }
                
                            // Append data to the result array
                            $getdata[] = [
                                'id' => $notesVal->id,
                                'heading' => ucwords($getRespoType[$notesVal->response_type] ?? 'Unknown'),
                                'adminname' => $adminname,
                                'comments' => $notesVal->comments,
                                'response_type' => $notesVal->response_type,
                                'data' => $getRespoType,
                                'created_date' => date('dS M Y H:i', strtotime($notesVal->created_date)),
                            ];
                        }
                }

                return $getdata; 
        }

        function getFunctionName() {

                $taskFunctions = [
                        '1' => 'salesTask',
                        '3' => 'HRTask',
                        '4' => 'reviewTask',
                        '5' => 'CustomTask',
                        '6' => 'reCleanTask',
                        '7' => 'unAssignTask',
                        '8' => 'otdTask',
                        '10' => 'cleanerQualityTask',
                        '11' => 'callCareTask',
                        '12' => 'complaintTask',
                        '13' => 'voucherData',
                    ];

                return $taskFunctions;    
        }


        function addTaskManager($task_id, $quote_id, $task_type, $follow_date, $follow_time, $response_type, $taskmanagerid, $job_id = 0, $admin_id = 0, $appid = 0, $comments = NULL)
        {
                // Updating the task_manager with completed_date and status
                DB::table('task_manager')
                        ->where('id', $taskmanagerid)
                        ->update([
                        'completed_date' => Carbon::now(),
                        'status' => 0,
                        'next_response' => $response_type,
                        ]);

                $completed_date = Carbon::now();
                $created_date = Carbon::now();

                if ($admin_id <= 0) {
                        $admin_id = session('id');
                }

                // Inserting into task_manager
                $lastid = DB::table('task_manager')->insertGetId([
                        'quote_id' => $quote_id,
                        'task_id' => $task_id,
                        'app_id' => $appid,
                        'job_id' => $job_id,
                        'task_type' => $task_type,
                        'status' => 1,
                        'created_date' => $created_date,
                        'admin_id' => $admin_id,
                        'response_type' => $response_type,
                        'fallow_date' => $follow_date,
                        'fallow_time' => $follow_time,
                        'comments' => $comments
                ]);

                // Updating the sales_task_track with the new task_manager_id
                DB::table('sales_task_track')
                        ->where('id', $task_id)
                        ->update([
                        'task_manager_id' => $lastid,
                        ]);
        }


        function getTrackDataInfo($salesid) {

                $getsalesInfo = (array) DB::table('sales_task_track')->select('id', 'quote_id', 'job_id', 'voucher_email','feedback_email','left_sms_date','second_email','threed_email','ans_date', 'app_id', 'fallow_created_date', 'track_type', 'fallow_date', 'fallow_time', 'task_manager_id')
                ->find($salesid);
            
                        // Check if 'fallow_date' and 'fallow_time' exist and are not null
                        if (!empty($getsalesInfo['fallow_date']) && !empty($getsalesInfo['fallow_time'])) {
                                $getsalesInfo['fallow_date_time'] = date('dS M', strtotime($getsalesInfo['fallow_date'])) . ' ' . $getsalesInfo['fallow_time'];
                        } else {
                                $getsalesInfo['fallow_date_time'] = null; // or handle the absence of the date and time in another way
                        }
                        
                        return $getsalesInfo;
            

        }

        function addNoteswithTrackManager($salesid ,  $response_type , $comments , $pageid , $getsales_follow = null) {

                 if(empty($getsales_follow)) {
                        $getsales_follow = DB::table('sales_task_track')
                        ->select('id', 'quote_id', 'job_id', 'app_id', 'track_type', 'fallow_created_date', 'fallow_date', 'fallow_time', 'task_manager_id')
                        ->find($salesid);
                 }
               
            
                if (!empty($getsales_follow)) {
                       
                        $trackInfo = [1]; //dd_value(179);

                        // dd($trackInfo);
                        //$pageName = $trackInfo[$pageid] ?? '';
                        //$heading = "{$task_result} for {$pageName}";
                        // $comments = $heading;

                        $this->addTaskManager(
                                $salesid,  
                                $getsales_follow->quote_id,
                                $getsales_follow->track_type,
                                $getsales_follow->fallow_date,
                                $getsales_follow->fallow_time,
                                $response_type,
                                $getsales_follow->task_manager_id,
                                0,
                                0,
                                $getsales_follow->app_id,
                                $comments
                        );
                
                        if (in_array($pageid, ($trackInfo))) {
                           $this->add_quote_notes($getsales_follow->quote_id, $comments, $comments);
                        }
                }
        }

                 function shortUrl($url, $format = 'json')
                {
     
                        $username = 'manish';
                        $password = 'Pcardin644@';
                        
                        // EDIT THIS: the query parameters 
                        $url     =   $url;  //'https://www.bcic.com.au/application/';  // URL to shrink
                        $keyword = '';                         // optional keyword
                        $title   = 'BCIC';                 // optional, if omitted YOURLS will lookup title with an HTTP request
                        $format  = 'json';                        // output format: 'json', 'xml' or 'simple'
                        
                        // EDIT THIS: the URL of the API file
                        $api_url = 'http://b2s.im/yourls-api.php'; // 'http://your-own-domain-here.com/yourls-api.php';
                        
                        
                        // Init the CURL session
                        $ch = curl_init();
                        curl_setopt( $ch, CURLOPT_URL, $api_url );
                        curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
                        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
                        curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
                        curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
                                        'url'      => $url,
                                        'keyword'  => $keyword,
                                        'title'    => $title,
                                        'format'   => $format,
                                        'action'   => 'shorturl',
                                        'username' => $username,
                                        'password' => $password
                                ) );
                                
                                $arr_result = json_decode(curl_exec($ch));
                                return $arr_result->shorturl;

  
                }  

                function siteUrl(){
                        return 'http://127.0.0.1:8000';  //https://www.bcic.com.au/
                }


                function getEmailSMSTemplate($quote_id, $salesid, $sms_type_id, $issmsEmail)
                {
                        // Fetch quote record
                        $quote = QuoteNew::select('id','name','ssecret','quote_for','site_id')->where('id', $quote_id)->first();

                        if (empty($quote->ssecret)) {
                        // Generate a random secret if not exists  
                        $secret = Str::random(15) . Str::random(25);
                        QuoteNew::where('id', $quote_id)->update(['ssecret' => $secret]);
                        } else {
                        $secret = $quote->ssecret;
                        }

                        //dd($quote);

                        // Fetch sales template
                        $sqltpl = DB::table('sales_template')->select('message','subject')->where('id', $sms_type_id)->first();

                        // Get site URL
                        $siteUrl = $this->siteUrl();

                        // Create URLs
                        $url = "{$siteUrl}/members/quote/index.php?action=checkkey&secret={$secret}";
                        $getURL = $this->shortUrl($url,'json');

                        $adminname = Session::get('name');
                        $qid = base64_encode(base64_encode($quote->id));
                        $shorturl = "{$siteUrl}/thank-you.php?action=thankyou&token={$qid}";
                        $spamlink = $this->shortUrl($shorturl,'json');

                        // Fetch quote for option $quote_for_option->booking_email
                        $quote_for_option = DB::table('quote_for_option')->select('phone','name','booking_email')->where('id', $quote->quote_for)->first();
                        // Determine protocol
                        // Build the message
                        $getlink = '<span style="color:#e46c0a;font-size: 22px;"><strong><u><a href="' . $getURL . '" target="_blank">CLICK HERE TO BOOK ONLINE NOW</a></u></strong></span>';
                        $booksmslink = $getURL;
                   // $booksmslinkwitjlink = '<a href="' . $getURL . '">' . $getURL . '</a>';
                        $s_number = '<a href="tel:' . $quote_for_option->phone . '">' . $quote_for_option->phone . '</a>';
                        $location = DB::table('sites')->where('id', $quote->site_id)->value('domain_text');
        
                        $getname = ['$cname', '$booknow', '$name', '$s_number', '$spamlink', '$quotforname', '$adminname', '$location', '$booksmslink', '\r\n'];
                        $replacedlink = [$quote_for_option->name, $getlink, $quote->name, $s_number, $spamlink, $quote_for_option->name, $adminname, $location, $booksmslink, ''];

                        // Fetch admin phone number
                        $getNumber = DB::table('c3cx_users')->select('phone_number')->where('adminid', Session::get('admin'))->first();

                        $sitesphone = !empty($getNumber->phone_number) ? $adminname . ' ' . $getNumber->phone_number : '';

                        $comment_msg = str_replace($getname, $replacedlink, $sqltpl->message) . ' - ' . $sitesphone;
                        $subject = $sqltpl->subject;
                        $quoteInfo = $quote->toArray();

                        return ['comment_msg'=>$comment_msg,'subject'=>$subject,'quotedata'=>$quoteInfo,'booking_email'=>$quote_for_option->booking_email];

                }

                function setEmailTpl($emailtpl) {

                        $html = $emailtpl;

                        $html .= '
                        <div style="">
                            <p>Should you have any enquiries in relation to this matter please do not hesitate to email us at <a href="mailto:hr@bcic.com.au">hr@bcic.com.au</a></p>
                            <p>Kind Regards,</p>
                            <p>BCIC Team</p>
                            <p>
                                p: 1300 599 644<br>
                                e: <a href="mailto:hr@bcic.com.au">hr@bcic.com.au</a><br>
                                w: <a href="http://bcic.com.au" target="_blank">bcic.com.au</a>
                            </p>
                            <p>
                                <a href="http://bcic.com.au" target="_blank">
                                    <img src="https://www.bcic.com.au/admin/images/service_logo.png" alt="BCIC Logo" style="max-width: 100px; height: auto; border: none;">
                                </a>
                            </p>
                            <div style="margin-top: 20px; font-size: 0.9em; color: #555;">
                                <p><strong>CAUTION:</strong> This email and any attachments may contain information that is confidential and subject to legal privilege. If you are not the intended recipient, you must not read, use, disseminate, distribute or copy this email or any attachments. If you have received this email in error, please notify us immediately and erase this email and any attachments. Thank you.</p>
                                <p><strong>DISCLAIMER:</strong> To the maximum extent permitted by law, BCIC is not liable (including in respect of negligence) for viruses or other defects or for changes made to this email or to any attachments. Before opening or using attachments, check them for viruses and other defects. The information contained in this document is confidential to the addressee and is not the view nor the official policy of BCIC unless otherwise stated.</p>
                            </div>
                        </div>';
                        
                        return $html;
                }

               

                function getFeedbackUrl($job_id)
                {
                        // Retrieve the short code from the 'jobs' table
                        $short_code = DB::table('jobs')->where('id', $job_id)->value('review_short_code');

                        if (empty($short_code)) {
                                // Generate a new review short code
                                $review_short_code = base64_encode($job_id . "__" . Str::random(3)); 
                                
                                // Update the 'jobs' table with the new short code
                                DB::table('jobs')->where('id', $job_id)->update(['review_short_code' => $review_short_code]);
                        } else {
                                $review_short_code = $short_code;
                        }

                        // Retrieve the site URL from the 'siteprefs' table
                        $url = $this->siteUrl(); //DB::table('siteprefs')->where('id', 1)->value('site_url');

                        // Generate the feedback URLs
                        $link = $url . "/feedback/index.php?tokenid=" . $review_short_code;
                        $link_2 = $url . "/feedback/feedback2.php?tokenid=" . $review_short_code;

                        return ['link1' => $link, 'link2' => $link_2];
                }

                function getReviewEmailTpl($type,$voucher_number) {
        
                        $eol = '<br/>';
                        
                        if($type == 1) {
                            
                             $str = '
                                   We hope this email finds you well. We tried to contact you over the phone but had no luck.'.$eol.'
                                   We recently had the pleasure of providing a bond cleaning service at your property, and we would greatly appreciate your feedback on the experience.'.$eol.'
                                   We understand that your time is precious but your feedback will help us identify areas where we excelled and areas where we can make improvements. '.$eol.''.$eol.'
                                   
                                   Your feedback is invaluable to us, and we sincerely appreciate your time and input. We are committed to continually improving our services, and your insights will contribute to that process. Thank you for being a valued customer.'.$eol.'
                                   We look forward to hearing from you soon.'.$eol.'
                                   Best regards,'.$eol.'
                                   Team BCIC.';
                                   
                                   
                        }else if($type == 2) {
                                
                                $str = '
                                        We greatly appreciate the time you have taken to share the feedback and we are thrilled to hear that your experience was positive.'.$eol.'
                                        As a gesture of our gratitude, we will like to offer you a gift voucher worth $50 that you can use towards your next purchase of either a spring clean or end of lease clean service. '.$eol.'
                                        Voucher Number ( '.$voucher_number.' )  <font style=""> Valid till date  '.date('dS M Y', strtotime('+1 Year')).'</font> '.$eol.' 
                                        Once again, thank you for choosing BCIC. We look forward to serving you again in the future.';
                                
                        }
                        
                        return $str;
                
                }

                function genRandomString()
                {

                        $length = 10;
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $string = '';
                        for ($p = 0;$p < $length;$p++)
                        {
                           $string .= $characters[mt_rand(0, strlen($characters)) ];
                        }

                        return ucwords($string);

                }

               

                function addGiftVouch($var) {
                        // Split the input variable
                        $vars = explode('|', $var);
                    
                        // Extract values
                        $job_id = $vars[0];
                        $job_amount = $vars[1];
                        $comments = $vars[2];
                        $typeInfo = $vars[3];
                        $voucher_number = $vars[4];
                    
                        // Set issue and expiration dates
                        $issueDate = Carbon::now()->format('Y-m-d');
                        $expDate = Carbon::now()->addYear()->format('Y-m-d');
                        $voucher_balance = 0;
                    
                        // Generate or use provided voucher number
                        if (!empty($voucher_number)) {
                            $emaiDate = Carbon::now()->format('Y-m-d H:i:s');
                        } else {
                            $voucher_number = $this->genRandomString(); // You need to define this function in Laravel.
                            $emaiDate = '0000-00-00 00:00:00';
                        }
                    
                        $status = 1;
                    
                        // Check if the job ID already exists
                        $exists = DB::table('gift_vouher')
                                    ->where('job_id', $job_id)
                                    ->exists();
                    
                        if (!$exists) {
                            // Insert new voucher record
                            DB::table('gift_vouher')->insert([
                                'job_id' => $job_id,
                                'amount' => $job_amount,
                                'comments' => $comments,
                                'issue_date' => $issueDate,
                                'exp_date' => $expDate,
                                'voucher_number' => $voucher_number,
                                'voucher_blance' => $voucher_balance,
                                'status' => $status,
                                'created_admin_id' => Session::get('id'),
                                'send_email_out' => $emaiDate,
                                'created_date' => Carbon::now()->format('Y-m-d H:i:s'),
                            ]);
                    
                            // Add job notes
                            $heading_data = 'Gift Voucher added';
                            $this->add_job_notes($job_id, $heading_data, $comments); // You need to define this function in Laravel.
                    
                            // Display success message
                            if (empty($typeInfo)) {
                                echo 'Gift Voucher Added';
                            }
                        } 
                }

                function totalAmountofJob($job_id)
                {
                        // Query the job_payments table using the Query Builder
                        $totalAmount = DB::table('job_payments')
                                ->where('job_id', $job_id)
                                ->where('payment_card_status', '!=', 2)
                                ->sum('amount');

                        // Return the total amount, ensuring it's a non-negative number
                        return $totalAmount > 0 ? $totalAmount : 0;
                }

                function sendNotification($data){

                         return  true;
                }

                
                function getjobDetailsJobType($job_id) 
                {
                         // Fetch job details
                        $job_details = JobDetail::select('job_date', 'job_type', 'staff_id', 'job_time','amount_total','discount','amount_staff',
                        'amount_profit','amt_share_type','staff_paid', 'id','job_id', 'site_id', 'job_type_id','job_sms_date',
                        'address_sms_date','add_notification_date','job_notification_date'
                        )
                                ->where('job_id', $job_id)
                                ->where('status', '!=', 2)
                                ->orderBy('job_type_id','ASC')
                                ->get();
                        
                        // Iterate over each job detail
                        foreach ($job_details as $val) {

                                $site_ids = $val->site_id;
                                $job_type_id = $val->job_type_id;
                                $job_type = $val->job_type;
                                $staff_id = $val->staff_id;

                                $val->staffname = ($staff_id > 0 ) ? get_rs_value('staff','name', $staff_id) : '';
                                
                                $queryInfo = DB::table('staff')
                                ->select('id', 'name')
                                ->where(function ($query) use ($site_ids) {
                                        $query->where('site_id', $site_ids)
                                        ->orWhere('site_id2', $site_ids)
                                        ->orWhereRaw('FIND_IN_SET(?, all_site_id)', [$site_ids]);
                                })
                                ->where('no_work', 1)
                                ->where('status', 1)
                                ->whereRaw('FIND_IN_SET(?, job_types)', [$val->job_type]);
                        
                                // Adjust the query based on job_type_id
                                if ($job_type_id == 2) {
                                  $queryInfo = $queryInfo->orWhere('carpet_share', 2);
                                } 
                        
                                // Get the result and attach it to the current job detail
                                $val->staffInfo = $queryInfo->get();
                        }

                        return $job_details; 
                }


                function recalcJobTotal($job_id, $quote_id) {
                        // Directly calculate the total amount in the job_details table
                        $tamount = JobDetail::where('job_id', $job_id)
                                            ->where('status', '!=', 2)
                                            ->sum('amount_total');
                    
                        // Update the job and quote in a single query if possible
                       // $job = Jobs::find($job_id);
                        
                            // Update the job and quote amounts in a single transaction
                            if(!empty($job_id)) {
                                Jobs::where('id', $job_id)->update(['customer_amount' => $tamount]);
                            }
                            if(!empty($quote_id)) {
                               QuoteNew::where('id', $quote_id)->update(['amount' => $tamount]);
                            }
                }

                function getrolename($typeid) {
                        $adminData = DB::table('admin')
                                ->where('status', 1)
                                ->where('is_call_allow', 1)
                                ->where('auto_role', $typeid)
                                ->where('login_status', 1)
                                ->inRandomOrder()
                                ->first(['id', 'name']);

                        if(!empty($adminData)) {
                                return ['id'=>$adminData->id , 'name'=>$adminData->name];
                        }  else{
                                return ['id'=>0 , 'name'=>''];
                        }   
                }

                function _paymentlist($jobid) {

                      $jobPaymentHistoryData =  DB::table('job_payments')->where('job_id', $jobid)->orderBy('id','DESC')->get();
                      return $jobPaymentHistoryData;

                }

                function getRefundList($job_id) {
                       
                        $refunds = DB::table('refund_amount')
                        ->where('is_deleted', 1)
                        ->where('job_id', $job_id)
                        ->orderBy('created_date','DESC')
                        ->get();

                        // Permissions
                        $adminall = [1, 2, 4, 12, 17, 41];
                        $permission = in_array(session('id'), $adminall);

                        // Mapping refund data to include necessary fields
                        $refunds = $refunds->map(function ($refund) use ($permission) {
                                $refund->refund_status = dd_id($refund->status, 96);
                                $refund->fault_status = dd_id($refund->fault_status, 97);
                                $refund->cleaner_name = $refund->cleaner_name > 0 ? get_rs_value('staff', 'name', $refund->cleaner_name) : '';
                                $refund->payment_job_status = $refund->refund_status == '1' ? 'SUCCESS' : 'Waiting';
                                $refund->delete_option = $permission && $refund->refund_status != '1' && $refund->status != 4 ? true : false;
                                $refund->payment_status_date = $refund->payment_status_date != '0000-00-00 00:00:00' ? date('dS M Y H:i', strtotime($refund->payment_status_date)) : 'N/A';
                                $refund->created_date = date('dS M Y H:i', strtotime($refund->created_date));
                                $refund->invoice_link = $refund->filename ? url('/refund/' . $refund->filename) : null;

                                return $refund;
                        });
                        return $refunds;
                       // return response()->json($refunds);
                }

              
                 // Helper function for denied staff
                function getJobDeniedStaffByReason ($job_id, $job_type_id)
                {
                        $staffData = DB::table('staff_jobs_status')
                                ->select(DB::raw("DISTINCT (SELECT name FROM staff WHERE id = staff_id) as sname"), 'job_id', 'job_type_id', 'staff_id', 'assign_type', 'created_at')
                                ->whereIn('status', [0, 2])
                                ->where('job_id', $job_id)
                                ->where('job_type_id', $job_type_id)
                                ->orderBy('id', 'desc')
                                ->get()
                                ->toArray();

                        $sname = [];
                        $staffIds = [];
                        $jobAllInfo = [];

                        foreach ($staffData as $data) {
                                $sname[] = $data->sname;
                                $staffIds[] = $data->staff_id;
                                $jobAllInfo[] = $data;
                        }

                        return ['sname' => $sname, 'statffid' => $staffIds, 'jobAllInfo' => $jobAllInfo];
                }

                // Helper function for available staff
                function checkAvailStaffData($site_id, $job_type_id, $job_date)
                {
                        $staffIds = DB::table('staff')
                                ->select('id')
                                ->where('status', 1)
                                ->where('no_work', 1)
                                ->where(function ($query) use ($site_id) {
                                $query->where('site_id', $site_id)
                                        ->orWhere('site_id2', $site_id)
                                        ->orWhereRaw("find_in_set(?, all_site_id)", [$site_id]);
                                })
                                ->whereRaw("find_in_set(?, amt_share_type)", [$job_type_id])
                                ->pluck('id')
                                ->toArray();

                        $availStaff = DB::table('staff_roster')
                                ->select(DB::raw("GROUP_CONCAT(DISTINCT (SELECT name FROM staff WHERE id = staff_id)) as staffid"))
                                ->whereIn('staff_id', $staffIds)
                                ->where('date', $job_date)
                                ->where('status', 1)
                                ->first();

                        return $availStaff;
                }

                // Helper function for staff who already have jobs
                function getHaveJob($site_id, $job_type_id, $job_date)
                {
                        $staffWithJobs = DB::table('job_details')
                                ->select(DB::raw("GROUP_CONCAT(DISTINCT (SELECT name FROM staff WHERE id = staff_id)) as staffid"))
                                ->where('status', '!=', 2)
                                ->where('job_type_id', $job_type_id)
                                ->where('job_date', $job_date)
                                ->where('site_id', $site_id)
                                ->first();

                        return $staffWithJobs;
                }

                // Helper function for reason for deny
                function getReasonForDeny($job_id, $staff_id)
                {
                        $reason = DB::table('reason_for_deny')
                                ->select(DB::raw("(SELECT GROUP_CONCAT(name) FROM system_dd WHERE type = 76 AND id IN (reason_for_deny.reason_id)) as resanmaname"), 'deny_type')
                                ->where('job_id', $job_id)
                                ->where('staff_id', $staff_id)
                                ->first();

                        return ['reason_id' => $reason->resanmaname, 'deny_type' => $reason->deny_type];
                }

                function RemovedummyText($body) {

                        $body =   stripslashes($body);
                        $body = preg_replace('/<head[\s\S]*?<\/head>/i', '', $body);
                        //$htmlString = '<html><body dir="auto"><div dir="ltr" style="color: red; margin: 10px;"><meta http-equiv="content-type" content="text/html; charset=utf-8">Hi</div></body></html>';
                         $cleanedHtml = preg_replace('/\s*style="[^"]*"/i', '', $body);
                         $cleanedHtml = str_replace(['Â','â','€','â€'], '', $body);
                         //$cleanedHtml = preg_replace('/Â| +/', '', $cleanedHtml);
                         return $cleanedHtml;
                }


               
     
}
