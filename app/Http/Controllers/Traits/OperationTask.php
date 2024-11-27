<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\JobNotes;
use App\Models\QuoteNew;
use App\Models\BCICEmail;
use App\Models\Jobs;
use App\Models\Sites;

trait OperationTask
{


    
        public function getBeforeJobDay($stagesKey)
        {
            // Get current date for reuse
            $currentDate = now()->format('Y-m-d');
        
            // Start the query for the jobs
            $query = DB::table('jobs')
                ->join('quote_new', 'jobs.id', '=', 'quote_new.booking_id')
                ->select(
                    'jobs.id', 
                    'jobs.review_call_done', 
                    'quote_new.id as qid', 
                    'quote_new.name', 
                    'quote_new.email', 
                    'quote_new.phone', 
                    'quote_new.booking_id', 
                    'quote_new.site_id', 
                    'quote_new.booking_date', 
                    'jobs.job_date', 
                    'quote_new.amount',
                    'jobs.customer_amount',
                    DB::raw("(SELECT abv FROM sites WHERE id = quote_new.site_id) as sitename")
                )
                ->where('jobs.status', 1)
                ->where('jobs.job_date', '>', $currentDate);
        
            // Handle different stages based on the provided key
            switch ($stagesKey) {
                case '1':
                    Log::info('Stage Key 1 condition met');
                    $query->whereIn('jobs.id', function ($subQuery) use ($currentDate) { // Qualify the id
                        $subQuery->select('job_id')
                            ->from('job_details')
                            ->where('status', '!=', 2)
                            ->where('staff_id', 0)
                            ->where('job_date', '>', $currentDate);
                    });
                    break;
        
                case '4':
                case '6':
                    Log::info('Stage Key 4 or 6 condition met');
                    $query->whereIn('jobs.id', function ($subQuery) use ($currentDate) { // Qualify the id
                        $subQuery->select('job_id')
                            ->from('job_details')
                            ->where('status', '!=', 2)
                            //->where('staff_id', '!=', 0)
                            ->where('job_date', now()->addDay()->format('Y-m-d')); // Added 1 day
                    });
                    break;
        
                case '7':
                    Log::info('Stage Key 7 condition met');
                    $query->whereIn('jobs.id', function ($subQuery) use ($currentDate) { // Qualify the id
                        $subQuery->select('job_id')
                            ->from('job_details')
                            ->where('status', '!=', 2)
                            ->where('staff_id', '!=', 0)
                            ->where('job_date', now()->addDay()->format('Y-m-d')); // Added 1 day
                    });
                    break;
        
                case '9':
                    Log::info('Stage Key 9 condition met');
                    $query->whereIn('jobs.id', function ($subQuery) { // Qualify the id
                        $subQuery->select('job_id')
                            ->from('re_quoteing')
                            ->where('re_quote_status', '!=', 4)
                            ->where('re_quote', 2)
                            ->whereBetween(DB::raw('DATE(createdOn)'), [
                                now()->startOfMonth()->format('Y-m-d'),
                                now()->endOfMonth()->format('Y-m-d')
                            ]);
                    });
                    break;
        
                case '10':
                    Log::info('Stage Key 10 condition met');
                    $query->whereIn('jobs.id', function ($subQuery) use ($currentDate) { // Qualify the id
                        $subQuery->select('job_id')
                            ->from('job_details')
                            ->where('staff_id', 0)
                            ->where('job_date', '>', $currentDate)
                            ->where('status', '!=', 2);
                    });
                    break;
        
                case '11':
                    Log::info('Stage Key 11 condition met');
                    $query->whereIn('jobs.id', function ($subQuery) use ($currentDate) { // Qualify the id
                        $subQuery->select('job_id')
                            ->from('job_details')
                            ->where('staff_id', 0)
                            ->whereBetween('job_date', [
                                now()->addDay()->format('Y-m-d'),
                                now()->addDays(2)->format('Y-m-d')
                            ])
                            ->where('status', '!=', 2);
                    });
                    break;
        
                default:
                    Log::info('No valid stagesKey provided.');
                    return [];
            }
        
            // Execute the query and return results
            try {
                $results = $query->get();
        
                if ($results->isEmpty()) {
                    Log::info('No results found for Stage Key: ' . $stagesKey);
                }
        
                return $results->isNotEmpty() ? $results : [];
            } catch (\Exception $e) {
                Log::error('Query Error: ' . $e->getMessage());
                return []; // Handle error gracefully
            }
        }
    
        function onDayJobs($stagesKey, $today)
        {
            $query = DB::table('jobs')
                ->select(
                    'quote_new.id as qid',
                    'job_details.job_time as jtime',
                    'job_details.job_date as jobDate',
                    'job_details.job_acc_deny as WorkStatus',
                    'job_details.start_time as start',
                    'job_details.end_time as end',
                    'jobs.id as id',
                    'sites.name as site_name',
                    'sites.abv as site_abv',
                    'jobs.status as jobStatus',
                    'jobs.accept_terms_status as accepterms_status',
                    'jobs.team_id as teamname',
                    'jobs.team_name as team_name',
                    'quote_new.name as cx_name',
                    'quote_new.date as job_date',
                    'quote_new.booking_date as jdate',
                    'quote_new.email as email',
                    'quote_new.phone as phone',
                    'jobs.customer_amount as job_amt',
                    'jobs.upsell_denied as upselldenied',
                    'jobs.upsell_admin as upselladmin',
                    'jobs.upsell_required as upsellrequired',
                    'jobs.email_client_booking_conf as email_client_booking_conf',
                    'jobs.email_client_cleaner_details as email_client_cleaner_details',
                    'jobs.review_email_time as review_email_time',
                    'jobs.sms_client_cleaner_details as sms_client_cleaner_details',
                    DB::raw('GROUP_CONCAT(DISTINCT job_details.job_type) as job_types') // Concatenating job types
                )
                ->leftJoin('sites', 'jobs.site_id', '=', 'sites.id')
                ->leftJoin('quote_new', 'jobs.quote_id', '=', 'quote_new.id')
                ->leftJoin('job_details', 'job_details.quote_id', '=', 'quote_new.id')
                ->where('job_details.status', '!=', 2)
                ->where('jobs.status', '=', 1)
                ->where('job_details.job_date', '=', $today);
        
            // Add conditions based on stagesKey
            switch ($stagesKey) {
                case 0:
                    // No additional conditions for stage 0 (Total)
                    break;
                case 1:
                    // Not Started
                    $query->where('job_details.job_type_id', '!=', 13)
                        ->where('job_details.start_time', '=', '0000-00-00 00:00:00')
                        ->where('job_details.end_time', '=', '0000-00-00 00:00:00');
                    break;
                case 2:
                    $query->where('job_details.start_time', '!=', '0000-00-00 00:00:00')
                        ->where('job_details.end_time', '=', '0000-00-00 00:00:00')
                        ->whereNotIn('job_details.job_id', function ($subQuery) {
                            $subQuery->select('job_id')
                                ->from('job_befor_after_image')
                                ->whereIn('image_status', [1])
                                ->where('job_type_status', 1);
                        });
                    break;
                case 3:
                    // Before (uploaded and Work in progress)
                    $query->where('job_details.start_time', '!=', '0000-00-00 00:00:00')
                        ->where('job_details.end_time', '=', '0000-00-00 00:00:00')
                        ->whereIn('job_details.job_id', function ($subQuery) {
                            $subQuery->select('job_id')
                                ->from('job_befor_after_image')
                                ->whereIn('image_status', [1])
                                ->where('job_type_status', 1);
                        });
                    break;
                case 4:
                    // After
                    $query->where('job_details.end_time', '!=', '0000-00-00 00:00:00')
                        ->whereNotIn('job_details.job_id', function ($subQuery) {
                            $subQuery->select('job_id')
                                ->from('job_befor_after_image')
                                ->whereIn('image_status', [2])
                                ->where('job_type_status', 1);
                        });
                    break;
                case 5:
                    // Upsell
                    $query->where(function ($subQuery) {
                        $subQuery->whereIn('job_details.job_id', function ($subQuery) {
                            $subQuery->select('job_id')
                                ->from('job_befor_after_image')
                                ->whereIn('image_status', [5])
                                ->where('job_type_status', 1);
                        })->orWhere('havily_soiled', '=', 1);
                    });
                    break;
                case 6:
                    // No Guarantee
                    $query->whereIn('job_details.job_id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_befor_after_image')
                            ->whereIn('image_status', [4])
                            ->where('job_type_status', 1);
                    });
                    break;
                case 7:
                    // CheckList
                    $query->where('job_details.end_time', '!=', '0000-00-00 00:00:00')
                        ->whereNotIn('job_details.job_id', function ($subQuery) {
                            $subQuery->select('job_id')
                                ->from('job_befor_after_image')
                                ->whereIn('image_status', [3])
                                ->where('job_type_status', 1);
                        });
                    break;
                case 8:
                    // Complete
                    $query->where('job_details.start_time', '!=', '0000-00-00 00:00:00')
                        ->where('job_details.end_time', '!=', '0000-00-00 00:00:00');
                    break;
            }
        
            // Group by job ID and order by job type ID
            $query->groupBy('job_details.job_id')
                ->orderBy('job_details.job_type_id', 'asc');
        
            // Execute the query
            $results = $query->get();
        
            // Return results based on changeType
            return $results->isNotEmpty() ? $results : [];
        }
        

        function reclean_job_data($stageskey, $adminid = 0)
        {
            $date = now()->toDateString(); // Get current date in Y-m-d format
            $query = DB::table('jobs') // Start a query on the Job model
                ->join('quote_new', 'jobs.quote_id', '=', 'quote_new.id') // Join with the quote_new table
                ->join('job_reclean', 'jobs.id', '=', 'job_reclean.job_id') // Join with job_reclean table
                ->select('jobs.id', 'jobs.review_call_done', 
                        'quote_new.id as qid', 'quote_new.name', 'quote_new.email', 'quote_new.phone', 
                        'quote_new.booking_id', 'quote_new.site_id', 'quote_new.amount',
                        DB::raw("(SELECT abv FROM sites WHERE id = quote_new.site_id) as sitename"),
                        'job_reclean.job_type_id', 'job_reclean.start_time', 
                        'job_reclean.end_time','job_reclean.reclean_date', 'job_reclean.staff_id', 'job_reclean.job_type'); // Select required fields

            // Filter by status
            $query->where('jobs.status', 5);

            // Filter by admin ID
            if ($adminid === 'all') {
                // No additional condition needed
            } elseif ($adminid > 0) {
                $query->where('jobs.task_manage_id', $adminid);
            }

            // Add conditions based on stageskey
            switch ($stageskey) {
                case 1:
                    $query->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_reclean')
                            ->where('status', '!=', 2)
                            ->where('start_time', '0000-00-00 00:00:00')
                            ->where('reclean_updated_date', '0000-00-00 00:00:00')
                            ->where('reclean_date', now()->toDateString());
                    });
                    break;
                case 2:
                    $query->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_reclean')
                            ->where('status', '!=', 2)
                            ->where('start_time', '0000-00-00 00:00:00')
                            ->where('reclean_date', now()->toDateString());
                    });
                    break;
                case 3:
                    $query->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_reclean')
                            ->where('status', '!=', 2)
                            ->where('start_time', '!=', '0000-00-00 00:00:00')
                            ->where('reclean_date', now()->toDateString());
                    });
                    break;
                case 4:
                    $query->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_befor_after_image')
                            ->where('image_status', 1)
                            ->where('job_type_status', 2);
                    })->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_reclean')
                            ->where('status', '!=', 2)
                            ->where('reclean_date', now()->toDateString());
                    });
                    break;
                case 5:
                    $query->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_befor_after_image')
                            ->where('image_status', 2)
                            ->where('job_type_status', 2);
                    })->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_reclean')
                            ->where('status', '!=', 2)
                            ->where('reclean_date', now()->toDateString());
                    });
                    break;
                case 6:
                    $query->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_befor_after_image')
                            ->where('image_status', 3)
                            ->where('job_type_status', 2);
                    })->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_reclean')
                            ->where('status', '!=', 2)
                            ->where('reclean_date', now()->toDateString());
                    });
                    break;
                case 7:
                    $query->whereIn('jobs.id', function ($subQuery) {
                        $subQuery->select('job_id')
                            ->from('job_reclean')
                            ->where('status', '!=', 2)
                            ->where('reclean_status', 4)
                            ->where('reclean_date', now()->toDateString());
                    });
                    break;
            }

            // Execute the query and retrieve the results
            $results = $query->get();

            return $results->isNotEmpty() ? $results : [];
        }

        


        function applicationSystemInfo($stage, $adminid)
        {
            // Base query for staff applications
           // $fromdate, $todate, $siteid = 0
           $fromdate =  date('Y-m-d' , strtotime('- 6 month'));  // now()->startOfMonth()->format('Y-m-d');
           $todate =  now()->endOfMonth()->format('Y-m-d');
            $query = DB::table('staff_applications')
                ->select(
                    'id',
                    'given_name',
                    'admin_id',
                    DB::raw("(SELECT abv FROM sites WHERE id = site_id) as siteid"),
                    DB::raw("(SELECT name FROM admin WHERE id = admin_id) as adminname"),
                    'first_name',
                    'last_name',
                    'email',
                    'mobile',
                    'phone',
                    'step_status',
                    'date_started'
                )
                ->whereBetween('date_started', [date('Y-m-d', strtotime($fromdate)), date('Y-m-d', strtotime($todate))])
                ->whereNotIn('sutab_unsutab', [4, 5])
                ->where('denied_id', 0);
        
                // Filter by site_id if provided
                if (!empty($siteid) && $siteid != 0) {
                    $query->where('site_id', $siteid);
                }
            
                // Filter by admin_id if provided
                if (!empty($adminid) &&  $adminid != 0) {
                    $query->where('admin_id', $adminid);
                }
            
                // Order by id in descending order
                $query->orderBy('id', 'DESC');
            
                // Get the results
                $results = $query->get();
            
                // Organize the results by step_status
                $getinfo = [];
                foreach ($results as $data) {
                    $getinfo[$data->step_status][] = $data;
                }
            
                return $getinfo;
        }   


        function newPageRecleanData($stageskey, $adminid = 0)
        {
            // Set the current date
            $date = now()->format('Y-m-d');
        
            
            // Start building the query
            $query = DB::table('jobs')
                ->select(
                    'jobs.id',
                    'jobs.review_call_done',
                    'jobs.reclean_login_id',
                    'jobs.new_re_clean',
                    'jobs.reclean_received',
                    'jobs.reclean_status',
                    'jobs.reclean_region_notes',
                    'jobs.job_date',
                    'jobs.arrange_reclean_date_noti',
                    'jobs.awaiting_exit_report',
                    'jobs.exit_awating_admin',
                    'quote_new.name',
                    'quote_new.email',
                    'quote_new.phone',
                    DB::raw("(SELECT abv FROM sites WHERE id = jobs.site_id) as siteid"),
                    DB::raw("(SELECT name FROM admin WHERE id = jobs.reclean_login_id) as jobadminname"),
                    'quote_new.booking_date',
                    'quote_new.site_id',
                    'quote_new.amount',
                    'bcic_email.email_date',
                    'bcic_email.email_assign'
                )
                ->leftJoin('quote_new', 'quote_new.booking_id', '=', 'jobs.id')
                ->leftJoin('bcic_email', 'bcic_email.job_id', '=', 'jobs.id')
                ->where('jobs.status', 5) // Only fetch records with status 5
                ->where('jobs.reclean_status', $stageskey);
        
            // Handle the adminid condition
            if ($adminid == 'all') {
                // Do nothing, fetch all records
            } elseif ($adminid > 0) {
                $query->where('jobs.reclean_login_id', $adminid);
            }
        
            // Execute the query and get the results
            $dataResults = $query->get();
        
            return $dataResults->map(function ($data) {
                // You can customize the result further if needed

                

                return [
                    'id' => $data->id,
                    'review_call_done' => $data->review_call_done,
                    'sitename' => $data->siteid,
                    'jobadminname' => $data->jobadminname,
                    'reclean_login_id' => $data->reclean_login_id,
                    'new_re_clean' => $data->new_re_clean,
                    'reclean_received' => $data->reclean_received,
                    'reclean_status' => $data->reclean_status,
                    'reclean_region_notes' => $data->reclean_region_notes,
                    'job_date' => $data->job_date,
                    'arrange_reclean_date_noti' => $data->arrange_reclean_date_noti,
                    'awaiting_exit_report' => $data->awaiting_exit_report,
                    'exit_awating_admin' => $data->exit_awating_admin,
                    'name' => $data->name ?? '',
                    'email' => $data->email ?? '',
                    'phone' => $data->phone ?? '',
                    'booking_date' => $data->booking_date ?? '',
                    'site_id' => $data->site_id ?? '',
                    'amount' => $data->amount ?? '',
                    'email_date' => $data->email_date ?? null,
                    'email_assign' => $data->email_assign ?? null,
                ];
            });
        }

        function getJobComplaints($stageskey, $adminid)
        {
            // Build the main query for job complaints
            $query = DB::table('job_complaint')
                ->where(function ($query) {
                    $query->where('complaint_date', '0000-00-00 00:00:00')
                        ->orWhereDate('complaint_date', now()->format('Y-m-d'))
                        ->orWhereDate('complaint_date', now()->subDay()->format('Y-m-d'));
                })
                ->whereIn('job_id', function ($subquery) {
                    $subquery->select('booking_id')
                        ->from('quote_new')
                        ->where('booking_id', '>', 0);
                })
                ->where('complaint_step_status', $stageskey);
        
            // Apply admin ID filter if applicable
            if ($adminid !== 'all' && $adminid > 0) {
                $query->where('admin_id', $adminid);
            }
        
            // Execute the query and get the results
            $dataResults = $query->get();
        
            // Initialize the result array
            $getdata1 = [];
        
            // Process results
            if ($dataResults->isNotEmpty()) {
                // Collect all job IDs from the results for a single query for quotes
                $bookingIds = $dataResults->pluck('job_id');
        
                // Fetch quote information in one query
                $quoteInfos = DB::table('quote_new')
                    ->select('id', 'name', 'booking_id', 'response', 'step', 'amount', 'denied_id', 'site_id', 'email', 'phone', 'date', 'booking_date')
                    ->whereIn('booking_id', $bookingIds)
                    ->get()
                    ->keyBy('booking_id'); // Key by booking_id for easy lookup
        
                // Merge quote info with complaint data
                foreach ($dataResults as $data) {

                     $jobtype =  ($data->job_type_id > 0) ? get_rs_value('job_type', 'name',$data->job_type_id) : '';
                    // Get corresponding quote info
                    $quoteInfo = $quoteInfos->get($data->job_id); // Use job_id from job_complaint
                    
        
                    // Initialize the merged data array
                    $mergedData = [
                        'name' => $quoteInfo->name ?? '',
                        'jobtype' => $jobtype ?? '',
                        'email' => $quoteInfo->email ?? '',
                        'phone' => $quoteInfo->phone ?? '',
                        'booking_date' => $quoteInfo->booking_date ?? '',
                        'site_id' => $quoteInfo->site_id ?? '',
                        'amount' => $quoteInfo->amount ?? '',
                        'response' => $quoteInfo->response ?? '',
                        'step' => $quoteInfo->step ?? '',
                    ];
        
                    // Add additional complaint data if needed
                    $mergedData += (array)$data; // Merge complaint data as well if necessary
        
                    // Store the merged result
                    $getdata1[] = $mergedData; 
                }
            }
        
            return $getdata1;
        }

        function getNewReviewSystem($stage, $adminId)
        {
            // Define the date range
            $fromDate = Carbon::now()->subMonths(2)->startOfMonth()->format('Y-m-d');
            $toDate = Carbon::now()->format('Y-m-d'); // Current date

            // Build the initial query
            $query = DB::table('quote_new')
                ->select(
                    'quote_new.id',
                    'quote_new.review_status',
                    'quote_new.booking_id',
                    'quote_new.booking_date',
                    'quote_new.name',
                    'quote_new.email',
                    'quote_new.phone',
                    DB::raw("(SELECT abv FROM sites WHERE id = site_id) as siteid"),
                    DB::raw("(SELECT name FROM system_dd WHERE id = (SELECT status FROM jobs WHERE type = 26 AND id = quote_new.booking_id)) as job_status"), // Use MAX to avoid multiple rows
                )
                ->where('quote_new.review_status', $stage)
                ->whereIn('quote_new.booking_id', function ($subQuery) use ($adminId, $fromDate, $toDate) {
                    $subQuery->select('job_id')
                        ->from('sales_task_track')
                        ->where('task_status', 1)
                        ->where('track_type', 6)
                        ->whereDate('createOn', '>', '2023-05-31');

                    // Add adminId condition if it is greater than 0
                    if ($adminId > 0) {
                        $subQuery->where('task_manage_id', $adminId);
                    }

                    // Add date filtering
                    $subQuery->whereDate('createOn', '>=', $fromDate)
                            ->whereDate('createOn', '<=', $toDate);
                });

            // Exclude booking_ids present in `job_complaint` and `job_reclean` tables
            $query->whereNotIn('quote_new.booking_id', function ($subQuery) {
                $subQuery->select('job_id')->from('job_complaint');
            })->whereNotIn('quote_new.booking_id', function ($subQuery) {
                $subQuery->select('job_id')->from('job_reclean');
            });

            // Exclude booking_ids present in the `bcic_review` table
            $query->whereNotIn('quote_new.booking_id', function ($subQuery) {
                $subQuery->select('job_id')->from('bcic_review');
            });

            // Execute the query and get the results
            $results = $query->get();

            // Return results if not empty, else return an empty array
            return $results->isNotEmpty() ? $results : [];
        }
    
         
        function jobAssignedOrNot($fromdate, $todate)
        {
            // Fetch jobs with the specified filters
            $jobs = DB::table('job_details')
                ->select('id', 'job_id', 'job_type_id', 'site_id', 'job_date', 'job_acc_deny', 'staff_id')
                ->whereBetween('job_date', [$fromdate, $todate])
                ->where('status', '!=', 2)
                ->whereNotIn('job_type_id', [9, 14, 13])
                ->where(function ($query) {
                    $query->where('staff_id', 0)
                          ->orWhere('job_acc_deny', 0);
                })
                ->whereIn('job_id', function ($query) {
                    $query->select('id')
                          ->from('jobs')
                          ->where('status', '!=', 2);
                })
                ->get();
        
            // Initialize the result array
            $getjobInfo = [];
        
            foreach ($jobs as $data) {
                $sitesData = $data->site_id > 0 
                ? Sites::select('id', 'abv', 'name')->find($data->site_id)
                : null;
                // Set the appropriate key based on staff_id
               // $jobAccDenyKey = $data->staff_id == 0 ? 10 : $data->job_acc_deny;
        
                $jobAccDenyKey = $data->staff_id == 0 ? 'un-asng' : 'asng';
                 //assigned
                // Build the nested structure
                 $getjobInfo[$data->job_date][$data->job_type_id][$jobAccDenyKey][$sitesData->abv][] = $data->job_id;
            }
        
            return $getjobInfo;
        }

       
          
        //$jobdetails =  $this->getDispatchReport($job_type_id, $from_date , $to_date, $site_id, $staff_id , $is_work);
            public function getDispatchReport($jobType, $startDate, $endDate)
            {

                //dump($jobType, $startDate, $endDate, $site_id , $staff_id , $no_work);

                // Convert the start and end dates to the required format using Carbon
                $startDate = Carbon::parse($startDate)->format('Y-m-d');
                $endDate = Carbon::parse($endDate)->format('Y-m-d');

                $jobStatus = dd_value(26);
                
                $query = DB::table('job_details')
                ->select(
                    'job_details.job_id',
                    'job_details.quote_id',
                    'job_details.job_type',
                    'job_details.job_type_id',
                    'job_details.job_date',
                    'job_details.reclean_job',
                    'job_details.staff_id',
                    'quote_details.description',
                    DB::raw('
                        CONCAT(
                            staff.name, "====",
                            staff.mobile
                        ) AS staffinfo
                    '),
                    DB::raw('
                        CONCAT(
                            quote_new.name, ", ",
                            quote_new.email, ", ",
                            quote_new.phone, ", ",
                            quote_new.suburb, ", ",
                            quote_new.postcode, ", ",
                            quote_new.address
                        ) AS quote_details
                    '),
                     DB::raw('(SELECT status 
                              FROM jobs where jobs.id = job_details.job_id )
                               AS jobstatus
                    '),
                    DB::raw('(SELECT reclean_date 
                              FROM job_reclean 
                              WHERE job_reclean.job_type_id = job_details.job_type_id 
                                AND job_reclean.job_id = job_details.job_id 
                                AND job_reclean.status != 2 
                              LIMIT 1) AS recleandate')
                )
                ->join('quote_new', 'quote_new.id', '=', 'job_details.quote_id')

                ->join('staff', 'staff.id', '=', 'job_details.staff_id')
                ->join('quote_details', function ($join) {
                    $join->on('quote_details.quote_id', '=', 'job_details.quote_id')
                         ->on('quote_details.job_type_id', '=', 'job_details.job_type_id');
                })
                ->where('job_details.status', '!=', 2)
                ->where('job_details.staff_id', '!=', 0)
                ->whereBetween('job_details.job_date', [$startDate, $endDate]);
            
                // Apply job type filter if provided
                if (!empty($jobType) && $jobType !== '0') {
                    $query->where('job_details.job_type_id',  $jobType);
                }

                // Apply job type filter if provided
                // if (!empty($site_id) && $site_id !== '0') {
                //     $query->where('job_details.site_id', $site_id);
                // }

                // if (!empty($site_id) && $site_id != "0") {
                //     $query->where(function ($queryNew) use ($site_id) {
                //         $queryNew->where('staff.site_id', $site_id)
                //             ->orWhere('staff.site_id2', $site_id)
                //             ->orWhereIn('staff.all_site_id', [$site_id]);
                //         });
                // }

                // // Apply job type filter if provided
                // if (!empty($staff_id) && $staff_id !== '0') {
                //     $query->where('job_details.staff_id', $staff_id);
                // }

                // // Apply job type filter if provided
                // if (!empty($no_work) && $no_work !== '0') {
                //     $query->where('staff.no_work', $no_work);
                // }

                
                
                // Filter for valid jobs based on the `jobs` table
                $query->whereIn('job_details.job_id', function ($subQuery) {
                    $subQuery->select('id')
                        ->from('jobs')
                        ->whereIn('status', [1, 3, 4, 5]);
                });
                
                // Add reclean jobs by including `orWhereIn`
                $query->orWhereIn('job_details.job_id', function ($recleanSubQuery) use ($startDate, $endDate) {
                    $recleanSubQuery->select('job_id')
                        ->from('job_reclean')
                        ->where('status', '!=', 2)
                        ->where('staff_id', '!=', 0)
                        ->whereBetween('reclean_date', [$startDate, $endDate]);
                });
                
                // Execute the query
                $jobDetails = $query->get();
                
                // Initialize the result array
                $groupedJobs = [];
                $staffisactive = [];
                
                // Process the results
                foreach ($jobDetails as $data) {
                    // Use reclean_date if available, else use job_date
                    $dateKey = !empty($data->recleandate) ? $data->recleandate : $data->job_date;
                    
                    // Ensure staff_id and dateKey are initialized
                    if (!isset($groupedJobs[$data->staff_id][$dateKey])) {
                        $groupedJobs[$data->staff_id][$dateKey] = [];
                    }
                    
                    // Check if job_id already exists
                    $existingIndex = null;
                    foreach ($groupedJobs[$data->staff_id][$dateKey] as $index => $entry) {
                        if ($entry['job_id'] === $data->job_id) {
                            $existingIndex = $index;
                            break;
                        }
                    }


                    $staffinfo = (!empty($data->staffinfo)) ? $data->staffinfo : '';

                     $stffinfodata = (!empty($staffinfo)) ? explode("====", $staffinfo) : [];
                     
                     $staffName = '';
                     $staffmobile = '';

                     if(!empty($stffinfodata)) {
                         $staffName = $stffinfodata[0];
                         $staffmobile = $stffinfodata[1];
                     }
                    

                    //  $getStaffCheck = DB::table('staff_roster')
                    //     ->where('staff_id', $data->staff_id)
                    //     ->whereBetween('reclean_date', [$startDate, $endDate])
                    //     ->get(); // Fetch the first matching row

                    // $castatus =  $getStaffCheck->status;  //(!empty($getStaffCheck) && $getStaffCheck->status === 1) ? 1 : 0;
                    // $staffisactive[$data->staff_id][$dateKey] = $castatus;

                    if ($existingIndex !== null)  {

                            // Add job_type to jobtypes array if not already present
                            if (!in_array($data->job_type, $groupedJobs[$data->staff_id][$dateKey][$existingIndex]['jobtypes'])) {
                                $groupedJobs[$data->staff_id][$dateKey][$existingIndex]['jobtypes'][] = ['job_name'=>$data->job_type, 'desc'=>$data->description,'staffName'=>$staffName, 'staffmobile'=>$staffmobile];
                            }

                    } else {
                        // Add new job entry
                        $groupedJobs[$data->staff_id][$dateKey][] = [
                            'quote_details' => $data->quote_details,
                            'job_id' => $data->job_id,
                            'castatus' => 0,
                            'quote_id' => $data->quote_id,
                            'job_type_id' => $data->job_type_id,
                            'job_date' => $data->job_date,
                            'staffinfo' => $data->staffinfo,
                            'jobstatusName' => (!empty($data->jobstatus)) ? $jobStatus[$data->jobstatus] : '',
                            'jobstatus' => $data->jobstatus,
                            'recleandate' => $data->recleandate,
                            'reclean_job' => $data->reclean_job,
                            'staff_id' => $data->staff_id,
                            'jobtypes' => [['job_name'=>$data->job_type, 'desc'=>$data->description,'staffName'=>$staffName, 'staffmobile'=>$staffmobile]], // Initialize jobtypes array with current job_type
                        ];
                    }

                   // $groupedJobs[$data->staff_id][$dateKey]['castatus'] = $castatus;
                }
                
                // Return the grouped jobs
                return ['jobdetails'=> $groupedJobs, 'staffroster'=>$staffisactive];
            }


      

        
}