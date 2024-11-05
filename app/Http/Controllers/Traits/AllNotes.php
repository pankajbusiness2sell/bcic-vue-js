<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\JobNotes;

trait AllNotes
{

             function add_application_notes($applId, $heading, $comment, $customDate = null, $customNameForcx = null, $adminId = null, $staffId = null, $messageId = 0) 
            {
                // If $customDate is null or empty, set it to the current timestamp
                        $customDate = empty($customDate) ? now() : $customDate;

                        // Determine staff name and admin ID based on $customNameForcx
                        if (!empty($customNameForcx)) {
                                $staffName1 = explode('__', $customNameForcx);
                                $staffName = $staffName1[0];
                                $adminId = $adminId;
                                $flagType = 1;
                        } else {
                                $staffName = Auth::user()->name;
                                $adminId = Auth::id();
                                $flagType = 0;
                        }

                        // Prepare data for insertion
                        $data = [
                                'application_id' => $applId,
                                'date' => $customDate,
                                'heading' => $heading,
                                'comment' => $comment,
                                'login_id' => $adminId,
                                'staff_id' => $staffId,
                                'messageid' => $messageId,
                                'flag_sms' => $flagType,
                                'staff_name' => $staffName,
                        ];

                        // Insert into application_notes table
                        DB::table('application_notes')->insert($data);
            }

            function addReviewNotes($reviewId, $heading, $comment, $adminName = null, $jobId = 0)
            {
                    $customDate = now();

                    if ($adminName) {
                            $staffName = $adminName;
                            $adminId = 0;
                    } else {
                            $staffName = Auth::user()->name;
                            $adminId = Auth::id();
                    }

                    DB::table('review_notes')->insert([
                            'review_id' => $reviewId,
                            'createdOn' => $customDate,
                            'heading'   => $heading,
                            'comment'   => $comment,
                            'login_id'  => $adminId,
                            'job_id'    => $jobId,
                            'staff_name'=> $staffName,
                    ]);
            }

            function add_quote_notes($quote_id, $heading, $comment, $customDate = null, $customNameForcx = null, $adminId = null, $importId = null)
            {
                    
                    $customDate = $customDate ?: Carbon::now();
                    $staff_name = $customNameForcx ? $customNameForcx : Session::get('name');
                    $admin_id = $adminId ? $adminId : Session::get('id');
    
                    $data = [
                            'quote_id' => $quote_id,
                            'date' => $customDate,
                            'heading' => $heading,
                            'comment' => $comment,
                            'login_id' => $admin_id,
                            'staff_name' => $staff_name
                    ];
    
                    if ($importId) {
                            $data['3cx_upload_id'] = $importId;
                    }
    
                    DB::table('quote_notes')->insert($data);
            }

            function add_job_notes($jobId, $heading, $comment, $customDate = null, $customNameForcx = null, $adminId = null, $importId = null, $quoteId = 0)
            {       
                    $customDate = (empty($customDate)) ? Carbon::now() : Carbon::parse($customDate);
                    $staffName  = !empty($customNameForcx) ? $customNameForcx : (Auth::check() ? Auth::user()->name : 'Automated');
                    $adminId = !empty($adminId) ? $adminId : (Auth::check() ? Auth::user()->id : '0');
    
                    // Insert the job note
                    JobNotes::insert([
                            'job_id' => $jobId,
                            'date' => $customDate,
                            'quote_id' => $quoteId,
                            'heading' => $heading,
                            'comment' => $comment,
                            'login_id' => $adminId,
                            'staff_name' => $staffName,
                            '3cx_upload_id' => $importId
                    ]);
            }

            public function addJobEmails($job_id, $heading, $comment, $email, $createdOn = null, $login_id = null, $staff_name = null)
            {
                 // Use Carbon to handle date or use current timestamp
                    $customDate = $createdOn ? Carbon::parse($createdOn)->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');

                    // Determine the admin ID and staff name
                    if (empty($login_id)) {
                            $admin_id = Auth::id(); // or session()->get('admin') if using sessions
                            $staff_name = session('name');
                    } else {
                            $admin_id = $login_id;
                            $staff_name = $staff_name;
                    }

                    // Create a new JobEmail record
                    DB::table('job_emails')->insert([
                            'job_id' => $job_id,
                            'date' => $customDate,
                            'email' => $email,
                            'heading' => $heading,
                            'comment' => $comment,
                            'login_id' => $admin_id,
                            'staff_name' => $staff_name,
                    ]);
            }

                function add_staff_notes($staffId, $jobId, $heading, $comment, $customDate = null, $customNameForCx = null, $adminId = null, $importId = null)
                {
                        // If no custom date is provided, use the current timestamp
                        $customDate = $customDate ?: now();

                        // Determine staff name and admin ID based on parameters or session
                        if ($customNameForCx && $adminId > 0) {
                                $staffName = $customNameForCx;
                                $adminId = $adminId;
                        } else {
                                $staffName = Auth::user()->name; // Assuming the logged-in user is stored in the session
                                $adminId = Auth::id(); // Assuming the logged-in admin's ID
                        }

                        // Prepare the data for insertion
                        $data = [
                                'staff_id' => $staffId,
                                'job_id' => $jobId,
                                'date' => $customDate,
                                'heading' => $heading,
                                'comment' => $comment,
                                'login_id' => $adminId,
                                'staff_name' => $staffName,
                        ];

                        // Conditionally add the 3cx_upload_id field if $importId is not empty
                        if ($importId) {
                                $data['3cx_upload_id'] = $importId;
                        }

                        // Insert the data into the staff_notes table
                        DB::table('staff_notes')->insert($data);
                }

                function add_highlight_notes($job_id, $heading, $comment)
                {
                        // If no custom date is provided, use the current timestamp
                        $customDate =  now();

                        $staffName = Auth::user()->name; // Assuming the logged-in user is stored in the session
                        $adminId = Auth::id(); // Assuming the logged-in admin's ID

                        // Prepare the data for insertion
                        $data = [
                                'job_id' => $job_id,
                                'heading' => $heading,
                                'comment' => $comment,
                                'login_id' => $adminId,
                                'staff_name' => $staffName,
                                'date' => $customDate,
                        ];

                        DB::table('hightlited_notes')->insert($data);
                }

                function add_3pm_notes($jobId, $quoteId, $jdetailsId, $type, $comment, $heading)
                {
                        $customDate = now();  // Laravel's helper for current timestamp
                        $adminId = Auth::id(); // Assuming you're using Laravel authentication
                        $staffName = DB::table('admin')->where('id', $adminId)->value('name'); // Fetch staff name

                        // Insert the note into the database
                        DB::table('3pm_notes')->insert([
                                'j_id' => $jdetailsId,
                                'date' => $customDate,
                                'quote_id' => $quoteId,
                                'job_id' => $jobId,
                                'login_id' => $adminId,
                                'heading' => $heading,
                                'comment' => $comment,
                                'type' => $type,
                                'staff_name' => $staffName,
                        ]);
                }

                function add_reclean_notes($job_id, $heading, $comment, $customDate = null, $customNameForcx = null, $adminId = null, $importId = null, $quote_id = null, $specific_re_notes_staff = null)
                {
                        // Set default date if not provided
                        $customDate = $customDate ?: Carbon::now()->format('Y-m-d H:i:s');
                        
                        // Set staff name based on provided custom name or session
                        $staff_name = $customNameForcx ?: session('name');
                        
                        // Set admin ID from provided admin ID or session
                        $admin_id = $adminId ?: session('id');
                        // Fetch quote_id from jobs table if not provided
                        $quote_id = (!empty($quote_id)) ?: DB::table('jobs')->where('id', $job_id)->value('quote_id');
                        
                        // Prepare data for insertion
                        $data = [
                                'job_id' => $job_id,
                                'date' => $customDate,
                                'quote_id' => $quote_id,
                                'heading' => $heading,
                                'comment' => $comment,
                                'login_id' => $admin_id,
                                'staff_name' => $staff_name,
                        ];
                        // Optional fields
                        if ($importId) {
                                $data['3cx_upload_id'] = $importId;
                        }
                        
                        if ($specific_re_notes_staff) {
                                $data['specific_re_notes_staff'] = $specific_re_notes_staff;
                        }

                        // Insert data into reclean_notes table
                        DB::table('reclean_notes')->insert($data);
                }
  
                function get_reclean_list($job_id , $type) {

                        if($type == 2) {
                                $jobList = DB::table('reclean_notes')->where('job_id', $job_id)->where('specific_re_notes_staff' , 1)->orderBy('id','DESC')->get();
                                return (!empty($jobList)) ? $jobList : [];
                        }

                        $jobList = DB::table('reclean_notes')->where('job_id', $job_id)->orderBy('id','DESC')->get();
                        return (!empty($jobList)) ? $jobList : [];
                }

                function get_job_list($job_id) {
                        $jobList = JobNotes::where('job_id', $job_id)->orderBy('id','DESC')->get();
                        return (!empty($jobList)) ? $jobList : [];
                }

                function get_staff_list($job_id) {
                        $jobList = DB::table('staff_notes')->where('job_id', $job_id)->orderBy('id','DESC')->get();
                        return (!empty($jobList)) ? $jobList : [];
                }

                function get_highlight_list($job_id) {
                        $jobList = DB::table('hightlited_notes')->where('job_id', $job_id)->orderBy('id','DESC')->get();
                        return (!empty($jobList)) ? $jobList : [];
                }

                function get_3pm_note_list($job_id) {
                        $jobList = DB::table('3pm_notes')->where('job_id', $job_id)->orderBy('id','DESC')->get();
                        return (!empty($jobList)) ? $jobList : [];
                }

                function add_cleaner_notes($jobId, $heading, $comment, $issueType, $staffId, $faultType = 3, $jobDate = null)
                        {
                                // Get the current timestamp
                                $customDate = Carbon::now();

                                // Get logged-in admin details
                                $adminId = Auth::id();  // Assuming the admin is logged in
                                $staffName = Auth::user()->name; // Assuming you have a name field in your users table

                                // Fetch the quote_id based on the job_id
                                $quoteId = DB::table('jobs')->where('id', $jobId)->value('quote_id');

                                // Prepare the data for insertion
                                $data = [
                                        'job_id' => $jobId,
                                        'date' => $customDate,
                                        'quote_id' => $quoteId,
                                        'staff_id' => $staffId,
                                        'fault_type' => $faultType,
                                        'job_date' => $jobDate ?? $customDate, // If no job_date is provided, use the current date
                                        'heading' => $heading,
                                        'comment' => $comment,
                                        'login_id' => $adminId,
                                        'issue_type' => $issueType,
                                        'staff_name' => $staffName
                                ];

                                        // Insert data into cleaner_notes table
                                        DB::table('clener_notes')->insert($data);
                        }

                        function get_cleaner_list($job_id) {
                                $cleanerlist = DB::table('clener_notes')->where('job_id', $job_id)->orderBy('id','DESC')->get();
                                return (!empty($cleanerlist)) ? $cleanerlist : [];
                        }    



                
}