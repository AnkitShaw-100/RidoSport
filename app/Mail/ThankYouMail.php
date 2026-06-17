<?php

// app/Mail/ThankYouMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        // No need to pass form data, just a thank you message
    }

    public function build()
    {
        return $this->subject('Thank You for Contacting Us')
                    ->view('frontend.emails.thankyou');
    }
}
