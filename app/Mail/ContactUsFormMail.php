<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact; // This will hold the contact form data

    /**
     * Create a new message instance.
     *
     * @param array $contact
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact; // Set the contact data
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Contact Us Form Submission')
                    ->view('frontend.emails.contact_us'); // Use your Blade view for email
    }
}
