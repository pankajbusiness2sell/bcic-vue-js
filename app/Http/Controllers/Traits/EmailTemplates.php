<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\JobNotes;
use App\Models\QuoteNew;
use App\Models\JobDetail;
use App\Models\QuoteDetails;
use App\Models\Sites;
use App\Models\TruckList;
use App\Models\Jobs;



trait EmailTemplates
{
      

            function sendEmailConfTemplate($job_id)
            {
                // Fetch job, quote, site, and job payments
                //$job = DB::table('jobs')->where('id', $job_id)->first();
                $quote = QuoteNew::where('booking_id', $job_id)->first();
                $site = Sites::select('domain','term_condition_link','br_domain','site_phone_number', 'br_term_condition_link','br_inclusion_link',)->where('id', $quote->site_id)->first();
                $jobPayment = DB::table('job_payments')->where('job_id', $job_id)->sum('amount');
            
                  // Fetch quote for option
                  // $quote->quote_for = 4;
                 $quoteForOption = DB::table('quote_for_option')->where('id', $quote->quote_for)->first();
                
                // Determine domain and term condition link
                switch ($quote->quote_for) {
                    case 1:
                        $domain = $site->domain;
                        $termConditionLink = $site->term_condition_link;
                        break;
                    case 2:
                    case 4:
                        $domain = $quoteForOption->site_url;
                        $termConditionLink = $quoteForOption->term_condition_link;
                        break;
                    case 3:
                        $domain = $site->br_domain;
                        $termConditionLink = $site->br_term_condition_link;
                        break;
                    default:
                        $domain = $site->domain;
                        $termConditionLink = $site->term_condition_link;
                }
            
                // Check job type
                $jobTypeDetails = DB::table('quote_details')
                    ->where('quote_id', $quote->id)
                    ->pluck('job_type_id')
                    ->toArray();
            
                if (in_array(25, $jobTypeDetails)) {
                    $domain = 'https://www.bettercleaning.com.au/';
                    $termConditionLink = 'https://www.bettercleaning.com.au/terms-and-conditions/';
                }
            
                if (in_array(4, $jobTypeDetails)) {
                    $domain = 'https://www.betterlawnmowing.com.au/';
                    $termConditionLink = 'https://www.betterlawnmowing.com.au/terms-and-conditions/';
                }
            
                $subtext = $quoteForOption->subject_name;
                if (in_array(11, $jobTypeDetails)) {
                    $domain = $site->br_domain;
                    $subtext = 'Removal';
                }
            
                $eol = "\r";
                $dateTxt = 'Date';
                $amtTxt = 'Estd.';
                $addr = 'Address: ' . $quote->address . $eol;
                $phoneNumber = 'Phone: ' . $quote->phone . $eol;
            
                if (in_array(11, $jobTypeDetails)) {
                    $dateTxt = 'Moving Date';
                    $amtTxt = 'Min.';
                    $addr = $eol;
                }
            
                $recunotes = '';
                if ($quote->recu_id > 0) {
                    $reccQuote = DB::table('recurring_quote_new')
                        ->where('quote_id', $quote->recu_id)
                        ->first();
            
                    $nextDate = Carbon::parse($reccQuote->next_date)->format('d M Y');
                    //$nextDate = $reccQuote->next_date;
                    
                    $recunotes = "<b>Your next job is scheduled at " . $nextDate . "</b>" . $eol;
                }
            
                $str = '';
                $bookingDate = Carbon::parse($quote->booking_date)->format('d M Y');
                $str .= 'Hello ' . $quote->name . $eol . $eol . 'Thanks for choosing ' . $domain . $eol .
                    'This email is to confirm that your ' . $subtext . ' job is booked with us. ' . $eol . $eol .
                    'Job Id: ' . $job_id . $eol .
                    $dateTxt . ' : ' . $bookingDate . $eol .
                    $addr . $phoneNumber;
                $str .= $amtTxt . ' Amount: $' . $quote->amount . $eol;
            
                if ($jobPayment > 0) {
                    $str .= 'Amount Received: $' . $jobPayment . $eol;
                }
            
                $jobDetails = DB::table('job_details')
                    ->where('job_id', $job_id)
                    ->where('status', '!=', 2)
                    ->where('job_type_id', '!=', 20)
                    ->get();
            
                $c_str = "";
                $br_in_bcic = 0;
                $checkjobtype = 0;
                $qDesc = "";
                foreach ($jobDetails as $jd) {
                    $quoteDetails = DB::table('quote_details')
                        ->where('quote_id', $jd->quote_id)
                        ->where('job_type_id', $jd->job_type_id)
                        ->first();
            
                    if ($jd->job_type_id == 11) {
                        $siteUrl1 = 'Site_url';
                        $qu_id = base64_encode($quote->id);
                        $url = $siteUrl1 . "/members/" . $qu_id . "/inventory";
            
                        $truckList = DB::table('truck_list')
                            ->where('id', $quoteDetails->truck_type_id)
                            ->first();
            
                        $bcicAmount = (!empty($truckList->amount)) ? (float) $truckList->amount : 0;
                        $truckTypeName = (!empty($truckList->truck_name)) ?  $truckList->truck_name : ''; //$truckList->truck_name;
                        $cubicMeter = (!empty($truckList->cubic_meter)) ?  $truckList->cubic_meter : ''; //$truckList->cubic_meter;
            
                        $qDesc = $eol . 'Moving From : ' . $quote->moving_from . ' ,' . $eol . ' Moving To : ' . $quote->moving_to . $eol;
                        $getEmailNotes = DB::table('quote_email_notes')
                            ->where('emal_type', 'booking_confirmation')
                            ->where('quote_for_type_id', 3)
                            ->first();
            
                        $br_in_bcic = 1;
                        $domain = $site->br_domain;
                        $brTermConditionLink = $site->br_term_condition_link;
                        $brInclusionLink = $site->br_inclusion_link;
            
                    } else if ($quoteDetails->job_type_id == 25) {
                        $getEmailNotes = DB::table('job_type')->select('id', 'confirm_notes as notes')
                            ->where('id', 25)
                            ->orderBy('id', 'desc')
                            ->first();
            
                        $domain = 'https://www.bettercleaning.com.au/';
                        $termConditionLink = 'https://www.bettercleaning.com.au/terms-and-conditions/';
                    } else if ($quoteDetails->job_type_id == 4) {
                        $getEmailNotes = DB::table('job_type')->select('id', 'confirm_notes as notes')
                            ->where('id', 4)
                            ->orderBy('id', 'desc')
                            ->first();
            
                        $domain = 'https://www.betterlawnmowing.com.au/';
                        $termConditionLink = 'https://www.betterlawnmowing.com.au/terms-and-conditions/';
                    } else {
                        $qDesc = "";
                        $getEmailNotes = DB::table('quote_email_notes')
                            ->where('quote_for_type_id', $quote->quote_for)
                            ->where('emal_type', 'booking_confirmation')
                            ->first();
                    }
            
                    $c_str .= $jd->job_type . ": " . $quoteDetails->description . $qDesc . $eol;
                }
            
                $str .= $c_str . $eol;
                $str .= $recunotes;
            
                $str .= 'Please Notes :-' . $eol;
                
            
                if ($br_in_bcic == 1) {
                    $link = "<a href='" . $termConditionLink . "'>term & conditions</a>";
                    $str .= str_replace('$tc', $link, strip_tags($getEmailNotes->notes)) . $eol;
                }else{
                    $str .= strip_tags($getEmailNotes->notes) . $eol;
                }
            
                if ($checkjobtype != 11) {
                    $str .= 'Credit Card (1 day Prior)' . $eol . '------------------------' . $eol .
                        'Please make sure that you send us the paid receipt of bank transfer.' . $eol .
                        'Please enter your Job Id for reference.' . $eol .
                        'Account Name: ' . $quoteForOption->account_name . $eol .
                        'BSB : ' . $quoteForOption->bsb . $eol .
                        'Account No: 295683522' . $eol . $eol .
            
                        'Bank Transfer (3 days Prior)' . $eol . '------------------------' . $eol .
                        'To Pay by Card, Please call on our Office Number' . $eol .
                        'Office number:' . $eol .
                        $site->site_phone_number . $eol . $eol .
                        'For Terms and Conditions, please refer to our website.' . $eol;
                }
            
                return trim($str);
            }


            public function sendEmailConf($job_id, $action = null)
            {
                $eol = '<br/>';
            
                // Fetch job, quote, site, job payment, and quote_for_option
                $quote = QuoteNew::where('booking_id', $job_id)->first();
                $site = Sites::select('domain', 'term_condition_link', 'br_domain', 'site_phone_number', 'br_term_condition_link', 'br_inclusion_link')
                    ->where('id', $quote->site_id)
                    ->first();
                $jobPayment = DB::table('job_payments')->where('job_id', $job_id)->sum('amount');
                $quoteForOption = DB::table('quote_for_option')->where('id', $quote->quote_for)->first();
            
                // Set domain and terms conditions based on quote_for
                $domain = $site->domain;
                $termConditionLink = $site->term_condition_link;
            
                if ($quote->quote_for == 1) {
                    $domain = $site->domain;
                    $termConditionLink = $site->term_condition_link;
                } elseif ($quote->quote_for == 2) {
                    $domain = $quoteForOption->site_url;
                    $termConditionLink = $quoteForOption->term_condition_link;
                } elseif ($quote->quote_for == 3) {
                    $domain = $site->br_domain;
                    $termConditionLink = $site->br_term_condition_link;
                }
            
                // Job type details
                $jobTypeDetails = QuoteDetails::where('quote_id', $quote->id)
                    ->pluck('job_type_id')
                    ->toArray();
            
                $checkQuote = 0;
                $amtText = '<strong>Estd</strong>';
                $jobDateText = '<strong>Job Date</strong>';
            
                if (in_array(11, $jobTypeDetails)) {
                    $checkQuote = 1;
                    $domain = $site->br_domain;
                    $amtText = '<strong>Min</strong>';
                    $jobDateText = '<strong>Moving Date</strong>';
                }
            
                if (in_array(4, $jobTypeDetails)) {
                    $checkQuote = 2;
                    $domain = 'https://www.betterlawnmowing.com.au/';
                }
            
                // Create email body content
                $str = "Hello {$quote->name},<br><br>Thanks for choosing <a href=\"{$domain}\">{$domain}</a><br>";
            
                if ($checkQuote == 1) {
                    $str .= "This email is to confirm that your Removal job is booked with us.<br><br>";
                } elseif ($checkQuote == 2) {
                    $str .= "This email is to confirm that your Lawn Mowing job is booked with us.<br><br>";
                } else {
                    $str .= "This email is to confirm that your {$quoteForOption->subject_name} job is booked with us.<br><br>";
                }
            
                $str .= "<strong>Job Id:</strong> {$job_id}<br>{$jobDateText}: " . date("d M Y", strtotime($quote->booking_date)) . "<br>";
            
                if ($checkQuote != 1) {
                    $str .= "<strong>Address:</strong> {$quote->address}<br>";
                }
            
                $str .= "<strong>Phone:</strong> {$quote->phone}<br>";
                $str .= "{$amtText} Amount: \${$quote->amount}<br>";
            
                // Recurring job notes
                $recunotes = '';
                if ($quote->recu_id > 0) {
                    $reccQuote = DB::table('recurring_quote_new')->select('next_date')->where('quote_id', $quote->recu_id)->first();
                    $nextDate = $reccQuote->next_date;
                    $recunotes = "<b>Your next job is scheduled at " . date("d M Y", strtotime($nextDate)) . "</b><br>";
                }
            
                // Additional job details logic
                $jobDetails = JobDetail::where('job_id', $job_id)
                    ->where('status', '!=', 2)
                    ->where('job_type_id', '!=', 20)
                    ->orderBy('job_type_id', 'asc')
                    ->get();
            
                $c_str = '';
                $flag_notes = 0;
                foreach ($jobDetails as $jd) {
                    $quoteDetails = QuoteDetails::where('quote_id', $jd->quote_id)
                        ->where('job_type_id', $jd->job_type_id)
                        ->first();
            
                    $qDesc = '';
                    if ($jd->job_type_id == 11) {
                        $truckList = TruckList::where('id', $quoteDetails->truck_type_id)->first();
            
                        $truckTypeName = $truckList->truck_name ?? '';
                        $qDesc = $eol . '<b>Moving From: </b> ' . $quote->moving_from . ' ,' . $eol . ' <b>Moving To: </b>' . $quote->moving_to . $eol;
                        $getEmailNotes = DB::table('quote_email_notes')
                            ->where('emal_type', 'booking_confirmation')
                            ->where('quote_for_type_id', 3)
                            ->first();
                    } elseif ($quoteDetails->job_type_id == 25) {
                        $getEmailNotes = DB::table('job_type')->select('id', 'confirm_notes as notes')
                            ->where('id', 25)
                            ->first();
                            $flag_notes = 1;
                    } elseif ($quoteDetails->job_type_id == 4) {
                        $getEmailNotes = DB::table('job_type')->select('id', 'confirm_notes as notes')
                            ->where('id', 4)
                            ->first();
                            $flag_notes = 2;
                    } else {
                        $getEmailNotes = DB::table('quote_email_notes')
                            ->where('quote_for_type_id', $quote->quote_for)
                            ->where('emal_type', 'booking_confirmation')
                            ->first();
                    }
            
                    $c_str .= "<b>" . $jd->job_type . "</b>: " . $quoteDetails->description . $qDesc . $eol;
                }
            
                $str .= $c_str . "";
            
                if ($jobPayment > 0) {
                    $str .= "<b>Amount Received:</b> \$ {$jobPayment}<br>";
                }
                $payment_agree_check = get_rs_value('jobs','payment_agree_check',$job_id);
                $termsCondi =  dd_value(107);
                if($payment_agree_check != 0) {
                    $str.= '<b>' .$termsCondi[$payment_agree_check].'</b><br>';
                 }
            
                $str .= $recunotes;
                $str .= "<strong>Please Note:</strong><br>";
                $str .= str_replace('$tc', "<a href='{$termConditionLink}'>terms & conditions</a>", $getEmailNotes->notes);
            
                if ($checkQuote != 1) {
                    $str .= '<table width="760" border="0" cellspacing="3" cellpadding="3">
                        <tr>
                            <td align="center" class="text12"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Credit Card (1 day Prior)</strong></font></td>
                            <td align="center" class="text12"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Bank Transfer (3 days Prior)</strong></font></td>
                        </tr>
                        <tr>
                            <td class="text12"><font size="2" face="Arial, Helvetica, sans-serif">To Pay by Card, Please call on our Office Number<br>Office number:<br>' . $site->site_phone_number . '</font></td>
                            <td class="text12"><font size="2" face="Arial, Helvetica, sans-serif">Please make sure that you send us the paid receipt of bank transfer.<br>Please enter your <strong>Job Id for reference</strong>.<br>Account Name: ' . $quoteForOption->account_name . '<br>BSB: ' . $quoteForOption->bsb . '<br>Account No: 295683522<br></font></td>
                        </tr>
                    </table>
                    For Terms and Conditions, please refer to our website.<br>';
                }
            
                if($checkQuote == 1) {
                    $subject = "Removal Booking Confirmation from ".$domain." Job Id #".$job_id;
                }else {
                    if($flag_notes == 1) {
                        $subject = "  Domestic Cleaning Booking Confirmation  ".$domain." Job Id #".$job_id;
                    }else if($flag_notes == 2) {
                        $subject = "  Gardening  Booking Confirmation  ".$domain." Job Id #".$job_id;
                    }else {
                      $subject = $quoteForOption->subject_name ."  Booking Confirmation from ".$domain." Job Id #".$job_id;
                    }
                }

                $quotedata['name'] = $quote->name;
                $quotedata['email'] = $quote->email;
                $sendfrom  = $quoteForOption->email_out_booking;
                $this->sendemail($str , $quotedata, $subject,$sendfrom);
                $this->addJobEmails($job_id, $subject, $str, $quote->email);
                $this->add_job_notes($job_id, $subject, $subject);
                Jobs::where('id', $job_id)->update(['email_client_booking_conf' => now()]);
                return 1;
            }

            function sendemail($comment_msg , $quotedata, $newSubject , $sendfrom) {

                $comment_msg = $this->setEmailTpl($comment_msg);  

                Mail::html($comment_msg, function ($message) use ($quotedata, $newSubject, $sendfrom) {
                   
                    $message->to('pankaj.business2sell@gmail.com', $quotedata['name'])
                            ->subject($newSubject)
                            ->from($sendfrom);
                });
            }
            

            public function sendCleanerDetailsEmails($jobId)
            {
                $quote = QuoteNew::where('booking_id', $jobId)->first(); 

                $site = Sites::find($quote->site_id);
                $getQuoteType = DB::table('quote_for_option')->where('id', $quote->quote_for)->first();
        
                $jobTypeId = JobDetail::where('job_id', $jobId)
                    ->where('job_type_id', 11)
                    ->where('status', '!=', 2)
                    ->first();
        
                if ($jobTypeId) {
                    $domain = $site->br_domain;
                    $string = 'Removal Specialist';
                    $textSubj = 'Removal';
                } else {
                    if ($quote->quote_for == 2) {
                        $domain = $getQuoteType->site_url;
                    } else {
                        $domain = $site->domain;
                    }
        
                    $string = 'Cleaner';
                    $textSubj = 'Bond Cleaning';
                }
        
                if ($quote->quote_for == 4) {
                    $domain = 'https://www.betterhub.com.au/';
                }
        
                $subject = "$string Details from $domain Job Id #$jobId";
                $message = $this->sendCleanerDetailsTemp($jobId , $quote);

                $quotedata['name'] = $quote->name;
                $quotedata['email'] = $quote->email;
                $sendfrom  = $getQuoteType->email_out_booking;
                $this->sendemail($message , $quotedata, $subject,$sendfrom);
                $this->addJobEmails($jobId, $subject, $message, $quote->email);
                $this->add_job_notes($jobId, $subject, $subject);
                Jobs::where('id', $jobId)->update(['email_client_cleaner_details' => now()]);
                return 1;
        
            }

            public function sendCleanerDetailsTemp($jobId , $quote)
            {
                $eol = "<br>";
                //$quote = QuoteNew::where('booking_id', $jobId)->first();
                $jobDetails = JobDetail::where('job_id', $jobId)
                    ->where('status', '!=', 2)
                    ->get();
               
                $cStr = "";
        
                foreach ($jobDetails as $jd) {

                     $quoteDetails = QuoteDetails::where('quote_id', $jd->quote_id)
                        ->where('job_type_id', $jd->job_type_id)
                        ->first();
        
                        if ($quoteDetails->job_type_id == 11) {
                        
                            $truckList = DB::table('truck_list')
                                ->where('id', $quoteDetails->truck_type_id)
                                ->first();
                
                            $bcicAmount = (!empty($truckList->amount)) ? (float) $truckList->amount : 0;
                            $truckTypeName = (!empty($truckList->truck_name)) ?  $truckList->truck_name : ''; //$truckList->truck_name;
                            $cubicMeter = (!empty($truckList->cubic_meter)) ?  $truckList->cubic_meter : ''; //$truckList->cubic_meter;
            
            
                            $cStr .= "<strong>{$jd->job_type}</strong>: {$quoteDetails->description}<br>";
                            $cStr .= "<strong>Moving From :</strong> {$quote->moving_from}$eol<br>";
                            $cStr .= "<strong>Moving To :</strong> {$quote->moving_to}$eol<br>";
                            $cStr .= "Estimated {$quoteDetails->hours} Hours x \${$bcicAmount} / hour for {$truckTypeName} {$cubicMeter}cm3 $eol";
                        } else {
                            $cStr .= "<strong>{$jd->job_type}</strong>: {$quoteDetails->description}$eol";
                        }
                }
        
                $bookingDate = Carbon::parse($quote->booking_date)->format('d M Y');

                $amount = (!empty($quote->amount)) ? (float) $quote->amount : 0;

                $message = "Hello {$quote->name}$eol$eol";
                $message .= "We are all set for your job on " . $bookingDate . "$eol";
                $message .= $cStr . "$eol";
                $message .= "Job ID: $jobId$eol";
                $message .= "Job Date: " . $bookingDate . "$eol";
                $message .= "Address: {$quote->address}$eol";
                $message .= "Estd. Amount: \$ ". $amount;
        
                return $message;
            }


            function send_cleaner_details_to_clients($job_id)
            {
                    $heading = "";
                    $str = "";
                    $eol = " ";
                    $flag = 0;

                    // Retrieve the quote details
                    $quote = QuoteNew::select('quote_for','booking_date','name','phone')->where('booking_id', $job_id)->first();

                   
                    // Fetch job details excluding status 2
                    $job_details = JobDetail::select('job_type_id','staff_id','job_type')->where('job_id', $job_id)->where('status', '!=', 2)->get();

                    $c_str = "";
                    $msg1 = '';
                    $msg2 = '';
                    $sitetext = '';
                    $flag  = 0;
                    foreach ($job_details as $jd) {

                        // Check job_type_id for messages
                        if ($jd->job_type_id == 8) {
                            $msg1 = 'Please advise what time you would like the cleaner to start.';
                            $msg2 = 'Please inspect the property post the service.';
                            $flag = 1;
                        }

                        // Set heading and text based on job_type_id
                        if ($jd->job_type_id == 11) {
                            $heading = "Send Removal Details to Client SMS";
                            $text = 'Removal(s)';
                        } else {
                            $sitetext = ($quote->quote_for == 2) ? 'BBC' : 'BCIC';
                            $heading = "Send Cleaner Details to Client SMS";
                            $text = 'Cleaner(s)';
                        }

                        

                        // Retrieve staff details
                        $staff = DB::table('staff')->select('id','no_contact_staff_client','name','mobile')->where('id', $jd->staff_id)->first();


                        if(!empty($staff)) {
                            // Append staff details to c_str
                            if ($staff && $staff->no_contact_staff_client == 1) {
                                $c_str .= $jd->job_type . ': ' . $staff->name . " " . $staff->mobile . $eol;
                            } else {
                                $c_str .= $jd->job_type . ': ' . $staff->name . $eol;
                            }
                        }else{
                            $c_str .= $jd->job_type . ': '. $eol;
                        }
                        

                    }


                    // Modify sitetext if necessary
                    if ($quote->quote_for == 4) {
                        $sitetext = 'BetterHub';
                    }

                    $bookingDate = Carbon::parse($quote->booking_date)->format('d M Y');
                    // Construct message body
                    $str = 'Hello (#' . $job_id . ') ' . $quote->name . $eol . 'We are all set for your job on ' . $bookingDate . $eol;

                    if ($msg1 != '' && $flag == 1) {
                        $str .= $msg1 . $eol;
                    } else {
                        $str .= 'Please ensure that the property is completely vacated.' . $eol;
                    }

                    $str .= 'Your ' . $text . ' details are ' . $c_str . $eol;

                    if ($msg2 != '' && $flag == 1) {
                        $str .= $msg2 . $eol;
                    }

                    $str .= 'Thank You' . $eol;
                    $str .= $sitetext . ' Team';
                    
                    $sms_code = $this->send_sms(str_replace(" ", "", $quote->phone), $str, 2 , $job_id);  //1=>Quote,2=>Jobs,3=>Staff,4=>App,5=>Admin
                    
                    if ($sms_code == "1") {
                        $heading .= " (Delivered)";
                        $flag = 1;
                    } else {
                        $heading .= " <span style=\"color:red;\">(Failed)</span>";
                        $flag = 2;
                    }
                    // Add job notes
                    $this->add_job_notes($job_id, $heading, $str);

                    // Update job details
                    if ($flag == 1) {
                        Jobs::where('id', $job_id)->update(['sms_client_cleaner_details' => now()]);
                        $respCode = 1;
                    } else {
                        $respCode = 0;
                    }

                    return $respCode;
            }


}