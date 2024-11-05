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

trait BCICEmailTraits
{


    function checkJobAndQuoteID($field, $value, $emailIds)
    {

        //dump($field, $value, $emailIds);

         $flag = 0;
        // For Quote ID check
        if ($field === 'quote_id') {
            $quote = QuoteNew::where('id', $value)->where('deleted', 0)->first();
            if ($quote) {
                $emailDetails = BcicEmail::where('id', $emailIds)->first();
                    $this->addBcicQuoteEmails(
                        $value,
                        $emailDetails->email_subject,
                        $this->RemovedummyText($emailDetails->email_body),
                        $emailDetails->email_from,
                        $emailDetails->id,
                        $emailDetails->mail_type
                    );

                $flag = 1;
            }
        }
    
        // For Job ID check
        if ($field === 'job_id') {
            $job = Jobs::find($value);
            if ($job) {
                $emailDetails = BcicEmail::where('id', $emailIds)->first();
                
                    $this->addBcicJobEmails(
                        $value,
                        $emailDetails->email_subject,
                        $this->RemovedummyText($emailDetails->email_body),
                        $emailDetails->email_from,
                        $emailDetails->id,
                        $emailDetails->mail_type
                    );

                $flag = 1;
            }
        }

        return $flag;
    }
     


    function addBcicQuoteEmails($quoteId, $heading, $comment, $email, $emailId, $mailType)
    {
        // Assume $adminId is the currently logged in admin's ID
        $adminId = Auth::id(); 
        $staffName = 'Email'; // Can be replaced by logic to get actual staff name if needed
        
        // Insert into quote_emails table
        DB::table('quote_emails')->insert([
            'quote_id' => $quoteId,
            'quote_email' => $email,
            'heading' => $heading,
            'comment' => $comment,
            'createdOn' => Carbon::now(), // Automatically format date in Y-m-d H:i:s
            'bcic_email_id' => $emailId,
            'mail_type' => $mailType,
            'check_from' => 1,
            'login_id' => $adminId,
            'staff_name' => $staffName
        ]);
    }

    function addBcicJobEmails($jobId, $heading, $comment, $email, $emailId, $mailType)
    {
        // Assume $adminId is the currently logged in admin's ID
        $adminId = Auth::id(); 
        $staffName = DB::table('admin')->where('id', $adminId)->value('name'); // Fetching staff name from DB
    
        // Insert into job_emails table
        DB::table('job_emails')->insert([
            'job_id' => $jobId,
            'date' => Carbon::now(), // Automatically format date in Y-m-d H:i:s
            'email' => $email,
            'heading' => $heading,
            'comment' => $comment,
            'login_id' => $adminId,
            'check_from' => 1,
            'bcic_email_id' => $emailId,
            'mail_type' => $mailType,
            'staff_name' => $staffName
        ]);
    }


    function removeQuoteAndJobEmails($fields, $ids) {
        if ($fields == 'quote_id') {
            if (!empty($ids)) {
                DB::table('quote_emails')
                    ->where('bcic_email_id', $ids)
                    ->delete();
            }
        }
    
        if ($fields == 'job_id') {
            if (!empty($ids)) {
                DB::table('job_emails')
                    ->where('bcic_email_id',$ids)
                    ->delete();
            }
        }
    }

    function getEmailSignature () {
              
            $str =   '<p>Thank you again, have a great day, and I look forward to hearing from you.</p>
                        <p>Kind Regards,</p>

                        <table width="800" cellpadding="0" cellspacing="0" style="border: 1px solid #cccccc; border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #cccccc;">
                                        <img src="https://www.bcic.com.au/admin/images/service_logo.png" alt="BCIC Group Logo" style="display: block; width: 160px;">
                                    </td>
                                    <td align="left" style="background: #FFF; padding: 10px; border: 1px solid #cccccc;">
                                        <p style="color: #20a6c5; font-weight: 500; margin: 4px 0; font-size: 18px;">Team | BCIC Group</p>
                                        <p style="color: #20a6c5; font-weight: 500; font-size: 15px; margin: 4px 0;">
                                            <span style="font-weight: 600; color: #333;">Gold Coast | Adelaide | Newcastle | Sunshine Coast | Brisbane | Sydney | Melbourne | ACT | Perth | Townsville | Geelong | Hobart | Darwin | Ipswich | Port Macquarie</span>
                                        </p>
                                        <p style="color: #20a6c5; font-weight: 500; font-size: 15px; margin: 5px 0;">
                                            Phone: 
                                            <span style="font-weight: 500; color: #333; font-size: 14px;">
                                                For Cleaning, Call Us: 1300 599 644 | For Your Removal Needs, Call Us: 1300 766 422
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        ';  

              return $str;
    
    }

     function prepareSubjectEmail($subjectEmail, $action)
    {
        return $subjectEmail;

        // switch ($action) {
        //     case 1: // Reply
        //         return "Re:" . str_replace('Re:', '', $subjectEmail);
        //     case 2: // Forward
        //         return "Fw:" . str_replace('Fw:', '', $subjectEmail);
        //     default: // Draft save
        //         return $subjectEmail;
        // }
    }

   
    

     function getEmailConfiguration($configId , $type)
    {
        if($type == 1) {
            return DB::table('email_config')->where('email_type', $configId)->first();
        }else if($type == 2) {
            return DB::table('email_config')->where('id', $configId)->first();
        }else{
            return  '';
        }
        
    }

    function getEmailConfig(){
        return DB::table('email_config')->select('id','email_type')->where('status', 0)->get();
    }

     function validateEmailParameters($emailFrom, $userEmail, $subjectEmail, $bodyEmail)
    {
        if (empty($emailFrom) || empty($userEmail) || empty($subjectEmail) || empty($bodyEmail)) {
            return response()->json(['success' => false, 'message' => 'Required fields are missing'], 400);
        }
        return null;
    }

     function handleFileAttachments($files)
    {
        $attArr = [];
        if ($files) {
            $dateFolderName = date('Y_m_d');
            $folderPath = public_path('sent_attachment') . '/' . $dateFolderName;

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            foreach ($files as $fl) {
                $filename = $fl->getClientOriginalName();
                $attArr[] = $filename;
                $fl->move($folderPath, $filename);
            }
        }
        return $attArr;
    }

    function sendmailgunEmail($emailConfig, $subjectEmail, $bodyEmail, $toEmails, $ccEmails, $bccEmails, $attachmentPaths)
    {
        $MAILGUN_URL = env('MAILGUN_URL'); // Retrieve Mailgun URL from environment
        $MAILGUN_KEY = env('MAILGUN_KEY'); // Retrieve Mailgun API key from environment

        // Prepare cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $MAILGUN_URL);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        $post = [
            'from' => $emailConfig->user_email,
            'to' => 'pankaj.business2sell@gmail.com', //implode(',', $toEmails),
            'cc' => !empty($ccEmails) ? implode(',', $ccEmails) : null,
            'bcc' => !empty($bccEmails) ? implode(',', $bccEmails) : null,
            'subject' => $subjectEmail,
            'html' => $bodyEmail,
        ];

       //  dd($post);

        // Attach files if available
        if (!empty($attachmentPaths)) {
            foreach ($attachmentPaths as $key => $val) {
                $post['attachment[' . $key . ']'] = curl_file_create(public_path('sent_attachment/' . date('Y_m_d') . '/' . $val));
            }
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_USERPWD, $MAILGUN_KEY);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute cURL request
        $result = curl_exec($ch);

        if ($result === false) {
            return response()->json(['success' => false, 'message' => 'CURL Error: ' . curl_error($ch)], 500);
        }

        curl_close($ch);

        // Decode response
        $emailResponse = json_decode($result, true);

        if (isset($emailResponse['id']) && ($emailResponse['message'] == 'Queued. Thank you.')) {
            return 1;
        } else {
            return 0;
        }
    }

        function prepareEmailData($emailConfig, $emailFrom, $ccAddress, $bccAddress, $subjectEmail, $bodyEmail, $eAction, $adminId)
        {
            $currentDate = Carbon::now();

            $emaildata =  [
                'folder_type' => 'Sent',
                'email_date' => $currentDate->format('D, j M Y H:i:s O'),
                'mail_type' => $emailConfig->email_type,
                'cc_address' => (!empty($ccAddress)) ? $ccAddress : '',
                'bccaddress' => (!empty($bccAddress)) ? $bccAddress : '',
                'email_assign' => 3,
                'email_subject' => (!empty($subjectEmail)) ? $subjectEmail : '', 
                'email_subject_reference' => (!empty($subjectEmail)) ? $subjectEmail : '',  
                'email_message_id' => '',
                'email_references' => '',
                'email_toaddress' => $emailFrom,
                'email_to' => $emailFrom,
                'email_fromaddress' => $emailConfig->user_email,
                'email_from' => $emailConfig->user_email,
                'email_reply_toaddress' => $emailConfig->user_email,
                'email_reply_to' => $emailConfig->user_email,
                'email_mailbox' => '',
                'email_senderaddress' => $emailConfig->user_email,
                'email_sender' => $emailConfig->user_email,
                'email_recent' => '',
                'email_unseen' => 'U',
                'email_flagged' => '',
                'email_draft' => '',
                'email_msgno' => '',
                'email_maildate' => '',
                'email_size' => '',
                'email_udate' => strtotime(date('Y-m-d H:i:s')),
                'email_body' => $bodyEmail,
                'mail_flag' => $eAction,
                'job_id' => 0,
                'quote_id' => 0,
                'email_send_admin_id' => $adminId,
                'admin_id' => $adminId,
                'staff_id' => 0,
                'createdOn' => date('Y-m-d H:i:s'),
                'email_category' => (!empty($emailConfig->email_type)) ?  $this->emailtype($emailConfig->email_type) : 0,
                'mail_new_date' => date('Y-m-d H:i:s'),
            ];

          $lastemailid =   BCICEmail::insertGetId($emaildata);
          return $lastemailid;
        }


        function setFileAttachmentInsertion($email_id, $mail_type, $fileAtttment ,  $mailfolderName , $attachmentLocation)
        {
              
            if(!empty($fileAtttment)) 
            {
                $insertData = [];
                foreach ($fileAtttment as $attchValue) {
                    $insertData[] = [
                        'email_id' => $email_id,
                        'folder_type' => $mailfolderName,
                        'email_message_id' => '',
                        'email_attach' => (!empty($attchValue)) ? str_replace(' ','_',$attchValue) : '',
                        'email_folder' => $attachmentLocation,
                        'email_msgno' => 0,
                        'mail_type' => $mail_type,
                        'createdOn' => Carbon::now(),
                    ];
                }
                DB::table('bcic_email_attach')->insert($insertData);
            }
        }

        function emailtype($mail_type) {
            switch (strtolower($mail_type)) {
                case 'reviews':
                    return 11;
                case 'team':
                    return 10;
                case 'support':
                    return 3;
                case 'hr':
                    return 5;
                case 'voicemsg':
                    return 9;
                case 'reclean':
                    return 4;
                case 'chargeback':
                    return 13;
                case 'booking_bh':
                    return 14;
                case 'hr_bh':
                    return 15;
                case 'br_bookings':
                    return 16;
                case 'br_hr':
                    return 17;
                case 'dialpad':
                    return 18;
                case 'realestateva':
                    return 19;
                default:
                    return null; // Return null or any default value if $mail_type does not match any case
            }
        }


}