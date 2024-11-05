<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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


class OperationTask extends MasterController
{
    
     public function __construct()
    {
            $this->middleware('auth');
    }

    function getOperationSystem(Request $request) {

         return view('operation.operation_system');
    }
     
    public function getTrackdata(Request $request)
    {
        if ($request->expectsJson()) {
            $getData = [];
            $tracktype = (int)$request->input('tracktype', 0);
    
            if (empty($tracktype)) {
                return response()->json(['success' => false, 'data' => 'Please select track type'], 200);
            }
    
            $trackName = $request->input('trackname', []);
            
            if (!empty($trackName)) {
                foreach ($trackName as $key => $val) {
                    $getTotal = [];
                    
                    switch ($tracktype) {
                        case 1:
                            $getTotal = $this->getBeforeJobDay($key);
                            break;
                        case 2:
                            $today = date('Y-m-d');
                            $getTotal = $this->onDayJobs($key, $today);
                            break;
                        case 3:
                            $getTotal = []; // Placeholder
                            break;
                        case 4:
                            $getTotal = $this->reclean_job_data($key, 'all');
                            break;
                        case 5:
                            $getTotal = $this->getNewReviewSystem($key, '0');
                            break;
                        case 6:
                            $getDataTemp = $this->applicationSystemInfo(0, 0);
                            $getTotal = !empty($getDataTemp[$key]) ? $getDataTemp[$key] : [];
                            break;
                        case 7:
                            $getTotal = $this->newPageRecleanData($key, 'all');
                            break;
                        case 8:
                            $getTotal = $this->getJobComplaints($key, 'all');
                            break;
                        default:
                            $getTotal = [];
                            break;
                    }
    

                        $getPaymentData = [];
                        if ($tracktype == 1 && $key == 6 && !empty($getTotal)) {
                            foreach ($getTotal as $key2 => $job) {
                                // Initialize checkPayment to false
                                $job->checkPayment = false;
                        
                                // Fetch total payment amount for the current job
                                $getTotalAmount = DB::table('job_payments')->where('job_id', $job->id)->sum('amount');
                        
                                // Check if customer_amount and getTotalAmount are greater than 0
                                if (!empty($job->customer_amount) && $job->customer_amount > 0 && !empty($getTotalAmount) && $getTotalAmount > 0) {
                                    // If they are equal, set checkPayment to true
                                    if ($job->customer_amount == $getTotalAmount) {
                                        $job->checkPayment = true; // Set checkPayment to true for matching jobs
                                        $getTotal[] = $job; // Store matching job details
                                        //$getPaymentData[] = $job; // Optionally log or store matching job details if needed
                                    }
                                }
                            }
                        }

                          
                    $getData[$key] = [
                        'name' => $val,
                        'total' => count($getTotal),
                        'data' => $getTotal,
                        //'payment_data' => $getPaymentData // Include payment data if applicable
                    ];
                }
            }
    
            return response()->json(['success' => true, 'data' => $getData], 200);
        }
    
        return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
    }

    function trackQuestion(Request $request)
    {

        if($request->expectsJson()) 
        {
                $job_id = $request->input('job_id', 0);
                $quote_id = $request->input('quote_id', 0);
                $subTrackid = $request->input('subTrackid');
                $trackid = $request->input('trackid');

                $pageName = $request->input('pageName');
                $trackName = $request->input('trackName');

                
                    $oprQuestion = DB::table('operation_ans')->select('question_id as id', 'question_name as qus', 'ans as chekedans')
                    ->where('job_id', $job_id)
                    ->where('track_id', $trackid)
                    ->where('track_head_id', $subTrackid)
                    ->get();

                    if ($oprQuestion->isNotEmpty()) {
                        $getData = $oprQuestion;
                        $isAns = true;
                    } else {
                        // If no results, query from 'operation_checklist' table
                        $getData = DB::table('operation_checklist')
                            ->where('tracks_id', $trackid)
                            ->where('track_heading', $subTrackid)
                            ->where('status', 1)
                            ->get();
                            $isAns = false;
                    }     

                $getDataInfo = ['job_id'=>$job_id  ,'pageName'=>$pageName, 'trackName'=>$trackName , 'data'=>$getData ,'isAns'=>$isAns ];

               return response()->json(['success' => true, 'data' => $getDataInfo], 200);

        }

        return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
    } 

    function saveTrackQuestion(Request $request) {
         
         $getalldata = $request->input('dataToSend');

         $job_id = $getalldata[0]['job_id'];
         $tracks_id = $getalldata[0]['tracks_id'];
         $track_heading = $getalldata[0]['track_heading'];
          
          //job_id , tracks_id,  track_heading
        if(!empty($getalldata)) {
            $insertData = []; // Initialize the array to hold insert data
            foreach ($getalldata as $key => $item) {

                
                 // dd($item['tracks_id']);
                $insertData[] = [
                    'sales_id' => 0,
                    'track_id' => $item['tracks_id'],
                    'track_head_id' => $item['track_heading'],
                    'question_id' => $item['questionid'],
                    'question_name' => $item['qus'],
                    'ans' => $item['isChecked'],
                    'job_id' => $item['job_id'],
                    'createdOn' => Carbon::now()->format('Y-m-d H:i:s'),
                    'admin_id' => session('id'),
                ];
            }

            $bool =  DB::table('operation_ans')->insert($insertData);
            if($bool) {
                
                $oprQuestion = DB::table('operation_ans')->select('question_id as id', 'question_name as qus', 'ans as chekedans')
                    ->where('job_id', $job_id)
                    ->where('track_id', $tracks_id)
                    ->where('track_head_id', $track_heading)
                    ->get();

                return response()->json(['success' => true,  'data'=>$oprQuestion  , 'message' => 'data has been saved successfully'], 200);
            }else{
                return response()->json(['success' => false, 'message' => 'data has been not saved'], 200);
            }
           
         }

         return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);

    }

    function taskReports(Request $request) {

         $pagename = $request->input('page','sales');
         $action = $request->input('action','sales-task');

         //page=sales&action=sales-task
         return view('operation.task_reports', ['pagename'=>$pagename, 'action'=>$action]);
    }

    function tracktaskAssign(Request $request) {
  
          //dd($request->all());
        if($request->expectsJson()) 
        {
          $chekcedid = $request->input('chekcedid');
          $taskType = $request->input('taskType');
          $adminid = $request->input('adminid');


           if($taskType == 1) {
                $adminDetails = (array) DB::table('admin')
                ->select(DB::raw('GROUP_CONCAT(id) as ids'))
                ->where('status', 1)
                ->where('is_call_allow', 1)
                ->where('login_status', 1)
                ->whereIn('auto_role', [1])
                ->orderBy('id')
                ->first();
           }else{
             $adminDetails['ids'] = $adminid;
           }

           if (!empty($adminDetails['ids'])) {
               $adminIds = explode(',', $adminDetails['ids']);
    
                  \Log::info('Checked IDs: ', $chekcedid);

                    if (count($adminIds) > 0) {
                        // Get sales task track records
                        $salesTasks = DB::table('sales_task_track')->select('id','task_manage_id','quote_id')
                            ->whereIn('id', $chekcedid)
                            ->where('track_type', 1)
                            ->get();

                    \Log::info('adminids: ', $adminIds);
                  //\Log::info('salesTask: ', $salesTasks);
                    //      dump($adminIds);   
                       // dd($salesTasks);
                      // \Log::info('salesTask: ', $salesTasks);

                            foreach ($salesTasks as $key => $task) {
                                $taskManageId = $adminIds[$key % count($adminIds)];
                
                                if ($taskManageId) {                                    
                                    // Insert into task sales assign
                                    DB::table('task_sales_assign')->insert([
                                        'admin_id' => $taskManageId,
                                        'created_date' => now(),
                                        'task_id' => $task->id,
                                    ]);
        
                                    $adminname = get_rs_value("admin", "name", $taskManageId);
                                    $loginAdmin = Session::get('name');
                                    $fromadminname = get_rs_value("admin", "name", $task->task_manage_id);
        
                                    $heading = "$loginAdmin Track Task Moved $fromadminname to $adminname";
                                    //add_quote_notes($task->quote_id, $heading1, $heading1);
                                    $this->add_quote_notes($task->quote_id,$heading,$heading);
        
                                    // Update task manage ID
                                    DB::table('sales_task_track')
                                        ->where('id', $task->id)
                                        ->where('track_type', 1)
                                        ->update(['task_manage_id' => $taskManageId]);
                                }
                            }
                    }

                return response()->json(['success' => true, 'message' => 'Task moved successfully'], 200);

            }else{
                return response()->json(['success' => false, 'message' => 'Task moved moved admin not found'], 200);
            }
        }

        return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);

          // dd($adminDetails);
    }


    function hrTaskTrackAssign(Request $request) {
  
        //dd($request->all());
      if($request->expectsJson()) 
      {
        $chekcedid = $request->input('chekcedid');
        $taskType = $request->input('taskType');
        $adminid = $request->input('adminid');


         if($taskType == 1) {
              $adminDetails = (array) DB::table('admin')
              ->select(DB::raw('GROUP_CONCAT(id) as ids'))
              ->where('status', 1)
              ->where('is_call_allow', 1)
              ->where('login_status', 1)
              ->whereIn('auto_role', [16])
              ->orderBy('id')
              ->first();
         }else{
           $adminDetails['ids'] = $adminid;
         }

            if (!empty($adminDetails['ids'])) {
                $adminIds = explode(',', $adminDetails['ids']);
    
                    \Log::info('HR Checked IDs: ', $chekcedid);

                    if (count($adminIds) > 0) {
                        // Get sales task track records
                        $salesTasks = DB::table('sales_task_track')->select('id','task_manage_id','quote_id','app_id')
                            ->whereIn('id', $chekcedid)
                            ->where('track_type', 5)
                            ->get();

                    \Log::info('adminids: ', $adminIds);
                    //\Log::info('salesTask: ', $salesTasks);
                    //      dump($adminIds);   
                        // dd($salesTasks);
                        // \Log::info('salesTask: ', $salesTasks);

                        foreach ($salesTasks as $key => $task) 
                            {
                                $taskManageId = $adminIds[$key % count($adminIds)];
                
                                if ($taskManageId) {   

                                        // Insert into task sales assign
                                        //   DB::table('task_sales_assign')->insert([
                                        //       'admin_id' => $taskManageId,
                                        //       'created_date' => now(),
                                        //       'task_id' => $task->id,
                                        //   ]);
        
                                    $adminname = get_rs_value("admin", "name", $taskManageId);
                                    $loginAdmin = Session::get('name');
                                    $fromadminname = get_rs_value("admin", "name", $task->task_manage_id);
        
                                    $heading = "$loginAdmin Track Task Moved $fromadminname to $adminname";
                                    //add_quote_notes($task->quote_id, $heading1, $heading1);
                                    $this->add_application_notes($task->app_id,$heading,$heading ,'','','', 0);
        
                                    // Update task manage ID
                                    DB::table('sales_task_track')
                                        ->where('id', $task->id)
                                        ->where('track_type', 5)
                                        ->update(['task_manage_id' => $taskManageId]);
                                }
                            }
                    }

                return response()->json(['success' => true, 'message' => 'Task moved successfully'], 200);

            }else{
                return response()->json(['success' => false, 'message' => 'Task moved moved admin not found'], 200);
            }
        }

        return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);

        // dd($adminDetails);
    }

        function reviewTaskAssign(Request $request) 
        {
            if($request->expectsJson()) 
            {
                $chekcedid = $request->input('chekcedid');
                $taskType = $request->input('taskType');
                $adminid = $request->input('adminid');


                if($taskType == 1) {
                    $adminDetails = (array) DB::table('admin')
                    ->select(DB::raw('GROUP_CONCAT(id) as ids'))
                    ->where('status', 1)
                    ->where('is_call_allow', 1)
                    ->where('login_status', 1)
                    ->orderBy('id')
                    ->first();
                }else{
                  $adminDetails['ids'] = $adminid;
                }

                 
                if (!empty($adminDetails['ids'])) {
                    $adminIds = explode(',', $adminDetails['ids']);
        
                        \Log::info('HR Checked IDs: ', $chekcedid);
    
                        if (count($adminIds) > 0) {
                            // Get sales task track records
                            $salesTasks = DB::table('sales_task_track')->select('id','task_manage_id','quote_id','app_id')
                                ->whereIn('id', $chekcedid)
                                ->where('track_type', 6)
                                ->get();
    
                        \Log::info('adminids: ', $adminIds);
                        //\Log::info('salesTask: ', $salesTasks);
                        //      dump($adminIds);   
                            // dd($salesTasks);
                            // \Log::info('salesTask: ', $salesTasks);
    
                            foreach ($salesTasks as $key => $task) 
                                {
                                    $taskManageId = $adminIds[$key % count($adminIds)];
                    
                                    if ($taskManageId) {   
    
                                          
                                        // $adminname = get_rs_value("admin", "name", $taskManageId);
                                        // $loginAdmin = Session::get('name');
                                        // $fromadminname = get_rs_value("admin", "name", $task->task_manage_id);
            
                                        // $heading = "$loginAdmin Track Task Moved $fromadminname to $adminname";
                                        //add_quote_notes($task->quote_id, $heading1, $heading1);
                                       // $this->add_application_notes($task->app_id,$heading,$heading ,'','','', 0);
            
                                        // Update task manage ID
                                        DB::table('sales_task_track')
                                            ->where('id', $task->id)
                                            ->update(['task_manage_id' => $taskManageId]);
                                    }
                                }
                        }
    
                    return response()->json(['success' => true, 'message' => 'Task moved successfully'], 200);
    
                }else{
                    return response()->json(['success' => false, 'message' => 'Task moved moved admin not found'], 200);
                }

            }
  
           return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
            
        }


        function recleanTaskAssign(Request $request) 
        {
            if($request->expectsJson()) 
            {
                $chekcedid = $request->input('chekcedid');
                $taskType = $request->input('taskType');
                $adminid = $request->input('adminid');


                if($taskType == 1) {
                    $adminDetails = (array) DB::table('admin')
                    ->select(DB::raw('GROUP_CONCAT(id) as ids'))
                    ->where('status', 1)
                    ->where('is_call_allow', 1)
                    ->where('login_status', 1)
                    ->orderBy('id')
                    ->first();
                }else{
                  $adminDetails['ids'] = $adminid;
                }

                 
                if (!empty($adminDetails['ids'])) {
                    $adminIds = explode(',', $adminDetails['ids']);
        
                        \Log::info('HR Checked IDs: ', $chekcedid);
    
                        if (count($adminIds) > 0) {
                            // Get sales task track records
                            $salesTasks = DB::table('sales_task_track')->select('id','task_manage_id','quote_id','app_id')
                                ->whereIn('id', $chekcedid)
                                ->where('track_type', 7)
                                ->get();
    
                        \Log::info('adminids: ', $adminIds);
                        //\Log::info('salesTask: ', $salesTasks);
                        //      dump($adminIds);   
                            // dd($salesTasks);
                            // \Log::info('salesTask: ', $salesTasks);
    
                            foreach ($salesTasks as $key => $task) 
                                {
                                    $taskManageId = $adminIds[$key % count($adminIds)];
                    
                                    if ($taskManageId) {   
    
                                        // Update task manage ID
                                        DB::table('sales_task_track')
                                            ->where('id', $task->id)
                                            ->update(['task_manage_id' => $taskManageId]);
                                    }
                                }
                        }
    
                    return response()->json(['success' => true, 'message' => 'Task moved successfully'], 200);
    
                }else{
                    return response()->json(['success' => false, 'message' => 'Task moved moved admin not found'], 200);
                }

            }
  
           return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
            
        }


        function customeTaskAssign(Request $request) 
        {
            if($request->expectsJson()) 
            {
                $chekcedid = $request->input('chekcedid');
                $taskType = $request->input('taskType');
                $adminid = $request->input('adminid');


                if($taskType == 1) {
                    $adminDetails = (array) DB::table('admin')
                    ->select(DB::raw('GROUP_CONCAT(id) as ids'))
                    ->where('status', 1)
                    ->where('is_call_allow', 1)
                    ->where('login_status', 1)
                    ->orderBy('id')
                    ->first();
                }else{
                  $adminDetails['ids'] = $adminid;
                }

                 
                if (!empty($adminDetails['ids'])) {
                    $adminIds = explode(',', $adminDetails['ids']);
        
                        \Log::info('HR Checked IDs: ', $chekcedid);
    
                        if (count($adminIds) > 0) {
                            // Get sales task track records
                            $salesTasks = DB::table('sales_task_track')->select('id','task_manage_id','quote_id','app_id')
                                ->whereIn('id', $chekcedid)
                                ->where('track_type', 4)
                                ->get();
    
                        \Log::info('adminids: ', $adminIds);
                        //\Log::info('salesTask: ', $salesTasks);
                        //      dump($adminIds);   
                            // dd($salesTasks);
                            // \Log::info('salesTask: ', $salesTasks);
    
                            foreach ($salesTasks as $key => $task) 
                                {
                                    $taskManageId = $adminIds[$key % count($adminIds)];
                    
                                    if ($taskManageId) {   
    
                                        // Update task manage ID
                                        DB::table('sales_task_track')
                                            ->where('id', $task->id)
                                            ->update(['task_manage_id' => $taskManageId]);
                                    }
                                }
                        }
    
                    return response()->json(['success' => true, 'message' => 'Task moved successfully'], 200);
    
                }else{
                    return response()->json(['success' => false, 'message' => 'Task moved moved admin not found'], 200);
                }

            }
  
           return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
            
        }


        function complaintTaskAssign(Request $request) 
        {
            if($request->expectsJson()) 
            {
                $chekcedid = $request->input('chekcedid');
                $taskType = $request->input('taskType');
                $adminid = $request->input('adminid');


                if($taskType == 1) {
                    $adminDetails = (array) DB::table('admin')
                    ->select(DB::raw('GROUP_CONCAT(id) as ids'))
                    ->where('status', 1)
                    ->where('is_call_allow', 1)
                    ->where('login_status', 1)
                    ->orderBy('id')
                    ->first();
                }else{
                  $adminDetails['ids'] = $adminid;
                }

                 
                if (!empty($adminDetails['ids'])) {
                    $adminIds = explode(',', $adminDetails['ids']);
        
                        \Log::info('HR Checked IDs: ', $chekcedid);
    
                        if (count($adminIds) > 0) {
                            // Get sales task track records
                            $salesTasks = DB::table('sales_task_track')->select('id','task_manage_id','quote_id','app_id')
                                ->whereIn('id', $chekcedid)
                                ->where('track_type', 12)
                                ->get();
    
                        \Log::info('adminids: ', $adminIds);
                        //\Log::info('salesTask: ', $salesTasks);
                        //      dump($adminIds);   
                            // dd($salesTasks);
                            // \Log::info('salesTask: ', $salesTasks);
    
                            foreach ($salesTasks as $key => $task) 
                                {
                                    $taskManageId = $adminIds[$key % count($adminIds)];
                    
                                    if ($taskManageId) {   
    
                                        // Update task manage ID
                                        DB::table('sales_task_track')
                                            ->where('id', $task->id)
                                            ->update(['task_manage_id' => $taskManageId]);
                                    }
                                }
                        }
    
                    return response()->json(['success' => true, 'message' => 'Task moved successfully'], 200);
    
                }else{
                    return response()->json(['success' => false, 'message' => 'Task moved moved admin not found'], 200);
                }

            }
  
           return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
            
        }

        function JobUnAssigned() {

            return view('operation.job_un_assign');
        }

        function getunAssigndata(Request $request) {

            if($request->expectsJson()) 
            {
                $fromdate = now()->addDay()->format('Y-m-d');
                $todate = now()->addDays(7)->format('Y-m-d');
                // Job types and status information
                $jobTypes = [
                    1 => 'Cleaning',
                    2 => 'Carpet',
                    3 => 'Pest',
                    11 => 'Removal'
                ];
                
                $accdenyInfo = [
                    0 => 'Assigned',
                    10 => 'Unassigned'
                ];


               $infodata =  $this->jobAssignedOrNot($fromdate , $todate);   // OpretionTask Trait

                return response()->json([
                    'fromDate' => $fromdate,
                    'toDate' => $todate,
                    'jobTypes' => $jobTypes,
                    'accdenyInfo' => $accdenyInfo,
                     'infodata' => $infodata
                ]);

            }

            return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
        }


        function getunAssignDataBySites(Request $request)
        {
            if($request->expectsJson()) 
            {
              
                $job_type_id = $request->input('job_type_id');
                $search_type_id = $request->input('search_type_id'); //$searchARR['search_type_id'];
                $fromDate = $request->input('fromDate');
                $toDate = $request->input('todate');

                // Build the base query
                $query = DB::table('job_details')
                    ->select(
                        'id',
                        'job_id',
                        'site_id',
                        'job_type_id',
                        'job_date',
                        DB::raw("GROUP_CONCAT((SELECT short_name FROM job_type WHERE id = job_details.job_type_id)) as jobabv"),
                        DB::raw("GROUP_CONCAT(id) as jid"),
                        'job_acc_deny',
                        'staff_id'
                    )
                    ->whereBetween('job_date', [$fromDate, $toDate])
                    ->where('status', '!=', 2)
                    ->whereNotIn('job_type_id', [9, 14, 13]);

                // Apply filters based on $job_type_id
                if ($job_type_id > 0 && $job_type_id !== 'all') {
                    $query->where('job_type_id', $job_type_id);
                }

                // Apply filters based on $search_type_id
                if ($search_type_id == '1') {
                    $query->where('staff_id', 0);
                } elseif ($search_type_id == '2') {
                    $query->where('staff_id', '!=', 0)
                        ->where('job_acc_deny', 0);
                } elseif ($search_type_id == '3' || $search_type_id == '0') {
                    $query->where(function($query) {
                        $query->where('staff_id', 0)
                            ->orWhere('job_acc_deny', 0);
                    });
                }

                // Add the subquery condition and grouping
                $query->whereIn('job_id', function($subquery) {
                    $subquery->select('id')
                            ->from('jobs')
                            ->whereNotIn('status', [2, 3]);
                })
                ->groupBy('job_id');

                // Execute the query and get the results as an array
                $results = $query->get()->toArray();

                // Process the results into the $getjobInfo array
                $getjobInfo = [];
                foreach ($results as $data) {
                    $typeIdKey = ($job_type_id == '0' || $job_type_id == 'all') ? 0 : $job_type_id;
                    $getjobInfo[$data->site_id][$data->job_date][$typeIdKey][$search_type_id][] = [ 'job_id'=>$data->job_id,'jobabv'=>$data->jobabv,'job_acc_deny'=>$data->job_acc_deny,'jid'=>$data->jid];
                        //"{$data->job_id}__{$data->jobabv}__{$data->job_acc_deny}__{$data->jid}";
                }

                //return $getjobInfo;
                return response()->json([
                    'getjobInfo' => $getjobInfo
                ]);
            }

            return response()->json(['success' => false, 'data' => 'Not a valid request'], 400);
        }

     

}