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




use App\Models\BCICEmail;

    // use App\Mail\ViewQuoteMmail;

    // use App\Models\QuoteFor;
    // use App\Models\JobType;
    // use App\Models\User;
    // use App\Models\TempQuote;
    // use App\Models\TempDetails;
    // use App\Models\QuoteNew;
    // use App\Models\TaskManager;
    // use App\Models\SalesTaskTrack;
    // use App\Models\QuoteDetails;
    // use App\Models\JobDetail;
    // use App\Models\Sites;
    // use App\Models\TruckList;
    // use App\Models\C3cxUser;
    // use App\Models\QuoteEmailNote;
    // use App\Models\SaveQuoteQuestion;
    // use App\Models\Jobs;
    // use App\Models\JobReclean;
    // use App\Models\Staff;
    // use App\Models\StaffJobsStatus;



class Emails extends MasterController
{
    // 
        // use SendSMS, AllNotes EmailTemplates;
        public function __construct()
        {
                $this->middleware('auth');
        }


        public function EmailIndex (Request $request) 
        {     
          
            return view('emails.email_page');
             
        }
 
        function getEmaillist(Request $request) 
        {
             
            // dd($request->all());

           
            if ($request->expectsJson()) {
                $folder_type = $request->input('folder_type', 'INBOX');
                $searchValue = $request->input('email_search_value',NULL);
                $priority = $request->input('priorty',0);
                $email_assign = $request->input('estatus',0);
                $email_category = $request->input('email_category',0);
                $adminid = $request->input('adminid',0);
                $search_type = $request->input('search_type',1);
                $page = $request->input('page',1);
            
                $emailQuery = DB::table('bcic_email')
                    ->where('is_delete', 0)
                    ->where('email_status', '1');
            
                // Add inbox/sent folder condition
                if (!empty($folder_type)) {
                    $emailQuery->where('folder_type', $folder_type);
                }

                if (!empty($email_assign)) {
                    $emailQuery->where('email_assign', $email_assign);
                }

                if (!empty($priority)) {
                    $emailQuery->where('priority', $priority);
                }

                if (!empty($email_category)) {
                    $emailQuery->where('email_category', $email_category);
                }

                if (!empty($adminid)) {
                    $emailQuery->where('admin_id', $adminid);
                }
            
                // Search by various fields (subject, body, from, etc.)
                if (!empty($searchValue)) {
                    $emailQuery->where(function ($query) use ($searchValue) {
                        $query->where('id', 'like', '%' . $searchValue . '%')
                            ->orWhere('email_subject', 'like', '%' . $searchValue . '%')
                            ->orWhere('email_body', 'like', '%' . $searchValue . '%')
                            ->orWhere('email_from', 'like', '%' . $searchValue . '%')
                            ->orWhere('email_toaddress', 'like', '%' . $searchValue . '%')
                            ->orWhere('job_id', 'like', '%' . $searchValue . '%')
                            ->orWhere('quote_id', 'like', '%' . $searchValue . '%')
                            ->orWhere('staff_id', 'like', '%' . $searchValue . '%')
                            ->orWhere('client_email_id', 'like', '%' . $searchValue . '%')
                            ->orWhere('real_agent_email_id', 'like', '%' . $searchValue . '%');
                    });
                }
            
                // Paginate the query and get results
                $paginatedEmails = $emailQuery->orderBy('id', 'DESC')->paginate(30);

                if ($paginatedEmails->isNotEmpty()) {
                  
                    foreach($paginatedEmails as $getData) {

                        $getData->email_date = (!empty($getData->email_date)) ? date('dS M Y H:i', strtotime($getData->email_date)) : date('ds M Y H:i', strtotime($getData->createdOn)) ;
                        
                        $emailAtteched = DB::table('bcic_email_attach')->where('email_id', $getData->id)->get();
                        $totalCount = $emailAtteched->count();

                        $getData->email_body  = $this->RemovedummyText($getData->email_body);
                        //$text = preg_replace("/<style\\b[^>]*>(.*?)<\\/style>/s", "", $text);
                        //$remove_character = array("\n", "\r\n", "\r" , "rn");
                        //$getData->id =    str_replace($remove_character , '' , $text);

                        $getData->is_attached =  (!empty($totalCount)) ? true: false;
                        
                        $getData->email_attached =  ($getData->is_attached) ? $emailAtteched: [];

                        $finaldata[] = $getData;
                    }

                }
            
                // Prepare email data for the response
                $emailData = [
                    'emaillist' => $paginatedEmails,
                    'currentPage' => $paginatedEmails->currentPage(),
                    'lastPage' => $paginatedEmails->lastPage(),
                    'total_count' => $paginatedEmails->total(),
                ];
            
                return response()->json($emailData);
            }
            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);

        }

        function getTotalEmails(Request $request) {
           
            if ($request->expectsJson()) {
                $totalEmailsByFolderType = DB::table('bcic_email')
                    ->selectRaw('folder_type, COUNT(*) as total')
                    ->where('is_delete', 0)
                    ->where('email_status', '1')
                    ->groupBy('folder_type')
                    ->pluck('total', 'folder_type');
                
                // Convert the results to an associative array
                $totalEmailsArray = $totalEmailsByFolderType->toArray();


                $emails = DB::table('bcic_email')->select('id', 'email_category')
                    ->where('is_delete', 0)
                    ->where('email_status', '1')
                    ->where('folder_type', 'INBOX')
                    ->where('email_assign', 1)
                    ->orderBy('id', 'DESC')
                    ->get();
                
                // Initialize an array to hold the grouped data
                $getData = [];
            
                // Group the results by email_category
                foreach ($emails as $email) {
                    $getData[$email->email_category][] = $email->id;
                }


                return response()->json(['totalemails'=>$totalEmailsArray, 'categoryemails'=>$getData]);
            }
            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }

        function emailUpdate(Request $request) {

         
            if ($request->expectsJson()) {
                

                $evalue = $request->input('value');
                $fieldname = $request->input('fieldname');
                $id = $request->input('id');
                $customefield = $request->input('customefield');
                $optionname = $request->input('optionname');
                $bool = 0;

                if(!empty($id) && !empty($fieldname)) {
                    $bool =  BCICEmail::where('id',$id)->update([$fieldname => $evalue]);
                }
                

                $success = ($bool === 1) ? true : false;

                if($success) {
                    $megNew = $customefield .' update successfully to '. $optionname;
                }else{
                    $megNew = $customefield .' not update  to '. $optionname;
                }
                
                return response()->json(['success' => $success, 'message' => $megNew], 200);
            }

            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }

        function QuoteJobUpdate(Request $request) {

            if ($request->expectsJson()) 
            {

                $evalue = $request->input('value');
                $fieldname = $request->input('fieldname');
                $id = $request->input('id');
                $customefield = $request->input('customefield');
                $optionname = $request->input('optionname');
                $bool = 0;

                $isValue =  $this->checkJobAndQuoteID($fieldname, $evalue, $id);

                $bool =  BCICEmail::where('id',$id)->update([$fieldname => $evalue]);

                $success = ($isValue === 1) ? true : false;
                $megNew = ($isValue === 1) ? $evalue.' Job id update successfully ' : $evalue.' not exits';

                return response()->json(['success' => $success, 'message' => $megNew], 200);

            }

            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }

        function jobQuoteRemoved(Request $request) {
            
            if ($request->expectsJson()) 
            {
                $type = $request->input('type');
                $id = $request->input('id');

                if($type == 1) {
                    $fieldname = 'job_id';
                    $fName = 'Job ID';
                }else if($type == 2) {
                    $fieldname = 'quote_id';
                    $fName = 'Quote ID';
                }
                $this->removeQuoteAndJobEmails($fieldname, $id);
                $bool =  BCICEmail::where('id',$id)->update([$fieldname => 0]);
                
                $success = ($bool === 1) ? true : false;
                $megNew = ($bool === 1) ? $fName.' removed  successfully ' : $fName.' not removed  ';

                return response()->json(['success' => $success, 'message' => $megNew], 200);

            }
            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);

        }

        function bcicTemplate(Request $request) {
            // Step 1: Define a unique cache key
            $cacheKey = 'bcic_templates';
        
            // Step 2: Retrieve cached data or query the database
            $emailTemplates = Cache::remember($cacheKey, 30 * 60, function () {
                // Query the bcic_template table and group by catename
                return DB::table('bcic_template')
                    ->select('id', 'heading', 'cat_id', 
                        DB::raw('(SELECT name FROM system_dd WHERE type = 176 AND id = bcic_template.cat_id) AS catename'), 
                        'message')
                    ->orderBy('cat_id', 'asc')
                    ->get()
                    ->groupBy('catename');
            });
        
            // Step 3: Return the response as JSON
            return response()->json($emailTemplates, 200);
        }

        function signatureEmil(Request $request) {
             $emailSign =  $this->getEmailSignature();
             return response()->json($emailSign, 200);
        }

     

        public function sendEmails(Request $request)
        {
            if ($request->expectsJson()) {

                $validatedData = $request->validate([
                    'email_from' => 'required',
                    'email_body' => 'required',
                    'email_subject' => 'required',
                ]);

                $adminId = auth()->user()->id;
                $adminName = auth()->user()->name;

                // Retrieve input values
                $emailFrom = $request->input('email_from');
                $bccAddress = $request->input('bcc_address');
                $ccAddress = $request->input('cc_address');
                $subjectEmail = $request->input('email_subject', 'No subject');
                $bodyEmail = $request->input('email_body');
                $templateId = $request->input('template_id');
                $emailId = $request->input('email_id');
                $configId = $request->input('config_id');
                $action = ucfirst($request->input('email_type')); // 1 => reply, 2 => forward, 3 => draft save
                $files = $request->file('files');

                $subjectEmail = $this->prepareSubjectEmail($subjectEmail, $action);
                $emailConfig = $this->getEmailConfiguration($configId , 1);

                if (!$emailConfig) {
                    return response()->json(['success' => false, 'message' => 'Email configuration not found'], 404);
                }

                // Validate email parameters
                $validationResponse = $this->validateEmailParameters($emailFrom, $emailConfig->user_email, $subjectEmail, $bodyEmail);
                if ($validationResponse) {
                    return $validationResponse;
                }

                // Prepare attachments if any
                $attachmentPaths = $this->handleFileAttachments($files);

                // Prepare email addresses
                $toEmails = !empty($emailFrom) ? explode(',', $emailFrom) : [];
                $bccEmails = !empty($bccAddress) ? explode(',', $bccAddress) : [];
                $ccEmails = !empty($ccAddress) ? explode(',', $ccAddress) : [];
                
                $emailActions = [
                    1 => 'Reply',
                    2 => 'Forward',
                    3 => 'New',
                    4 => 'Re-clean Complaint',
                    5 => 'Forward'
                ];
        
                // Default to 'New' if action not found
                $eAction = $emailActions[$action] ?? 'New';
                // Prepare email data to be saved
                // Send email
                $isSent = $this->sendmailgunEmail($emailConfig, $subjectEmail, $bodyEmail, $toEmails, $ccEmails, $bccEmails, $attachmentPaths);

                    if(isset($isSent) && ($isSent === 1)) {

                        $email_id = $this->prepareEmailData($emailConfig, $emailFrom, $ccAddress, $bccAddress, $subjectEmail, $bodyEmail, $eAction, $adminId);
                        
                        if(!empty($attachmentPaths)) {
                                $folderPath =  'sent_attachment/' . date('Y_m_d');
                                $this->setFileAttachmentInsertion($email_id, $configId, $attachmentPaths ,  'Sent', $folderPath);
                        }
                        
                         return response()->json(['success' => true, 'message' => 'Email sent successfully!'], 200);
                    
                    }else{
                        return response()->json(['success' => false, 'message' => 'Failed to send email'], 200);
                    }
                
            }

            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }

        function getbcicEmailConfig(Request $request) {

            if ($request->expectsJson()) 
            {
               $config =  $this->getEmailConfig();
               return response()->json(['success' => true, 'emailconfig' => $config], 200);
            }

            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }

        function newSendEmail(Request $request) {

           
             if ($request->expectsJson()) {
             
                
                $validatedData = $request->validate([
                    'mail_type' => 'required',
                    'to_emails' => 'required',
                    'subject_email' => 'required',
                ]);


                 $adminId = auth()->user()->id;
                 $adminName = auth()->user()->name;

                // Retrieve input values
                $mail_type = $request->input('mail_type');
                $template_id = $request->input('template_id');
                $to_emails = $request->input('to_emails');
                $is_active_staff = $request->input('is_active_staff');
                $ccAddress = $request->input('cc_email');
                $bcc_email = $request->input('bcc_email');
                $subjectEmail = $request->input('subject_email', 'No subject');
                $bodyEmail = $request->input('email_body');

              //  $action = 3; // 1 => reply, 2 => forward, 3 => draft save,  1= > New,      
                $files = $request->file('files');

                
              
                $emailConfig = $this->getEmailConfiguration($mail_type, 2);

                if (!$emailConfig) {
                    return response()->json(['success' => false, 'message' => 'Email configuration not found'], 404);
                }

                // Validate email parameters
                $validationResponse = $this->validateEmailParameters($to_emails, $emailConfig->user_email, $subjectEmail, $bodyEmail);
                if ($validationResponse) {
                    return $validationResponse;
                }

                // Prepare attachments if any
                $attachmentPaths = $this->handleFileAttachments($files);

                $toEmails = !empty($to_emails) ? explode(',', $to_emails) : [];
                $bccEmails = !empty($bcc_email) ? explode(',', $bcc_email) : [];
                $ccEmails = !empty($ccAddress) ? explode(',', $ccAddress) : [];
                $eAction = 'New';
                $staffallemails = [];
                if($is_active_staff == 1) {
                    $staffallemails = Staff::where('status', 1)->pluck('email')->toArray();
                }
                 $newbccEmails = array_merge($bccEmails , $staffallemails);

                $isSent = $this->sendmailgunEmail($emailConfig, $subjectEmail, $bodyEmail, $toEmails, $ccEmails, $newbccEmails, $attachmentPaths);
                

                if(isset($isSent) && ($isSent === 1)) {

                    $email_id = $this->prepareEmailData($emailConfig, $to_emails, $ccAddress, $bcc_email, $subjectEmail, $bodyEmail, $eAction, $adminId);
                    
                    if(!empty($attachmentPaths)) {
                            $folderPath =  'sent_attachment/' . date('Y_m_d');
                            $this->setFileAttachmentInsertion($email_id, $emailConfig->email_type, $attachmentPaths ,  'Sent', $folderPath);
                    }
                    
                     return response()->json(['success' => true, 'message' => 'Email sent successfully!'], 200);
                
                }else{
                    return response()->json(['success' => false, 'message' => 'Failed to send email'], 200);
                }
                 
               // return response()->json(['success' => true, 'message' => ''], 200);
            }

            return response()->json(['success' => false, 'message' => 'Not a valid request'], 400);
        }
}