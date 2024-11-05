<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ViewQuoteMmail extends Mailable
{
    use Queueable, SerializesModels;

    public $checkQUotetype;
    public $details;
    public $getemailNotes;
    public $jobDecData;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($checkQUotetype,$details, $getemailNotes, $jobDecData ,  $subject)
    {
        $this->checkQUotetype = $checkQUotetype;
        $this->details = $details;
        $this->getemailNotes = $getemailNotes;
        $this->jobDecData = $jobDecData;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
         //echo $this->checkQUotetype; die;

            return $this->from('bookings@bcic.com.au', 'Booking')
                        ->subject("{$this->subject}")
                        ->view('quote.view_quote_popup_page')
                        ->with([
                            'checkQUotetype' => $this->checkQUotetype,
                            'details' => $this->details,
                            'getemailNotes' => $this->getemailNotes,
                            'jobDecData' => $this->jobDecData,
                        ]);
    }
}