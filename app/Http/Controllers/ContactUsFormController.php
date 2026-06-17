<?php

namespace App\Http\Controllers;

use App\Models\ContactUsForm;
use Illuminate\Http\Request;
use App\Models\DownloadCourt;
use App\Mail\ContactUsFormMail; // Import the mailable
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;// Import the Mail facade

class ContactUsFormController extends Controller
{

    public function index()
    {
        $contactQueries = ContactUsForm::paginate(15); // Fetch all contact form submissions
        $courtQueries = DownloadCourt::paginate(15); // Fetch all court queries

        return view('dashboard', compact('contactQueries', 'courtQueries')); // Pass both queries to the view
        // return view('dashboard', compact('contactQueries')); // Pass the data to the 'dashboard' view
    }
    
    public function destroy($id){
        $contactData = ContactUsForm::find($id);
        $contactData->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully.');
    }

    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required', // Ensure the reCAPTCHA token exists
        ]);
    
        $recaptchaValid = $this->validateReCaptcha($request->input('g-recaptcha-response'));

        if (!$recaptchaValid) {
            return back()->withErrors(['captcha' => 'reCAPTCHA validation failed.']);
        }

        // Store form data in the database
        $contactData = ContactUsForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
	
        // Send email to recipients
        Mail::to(['mail@webiantdigitalindia.in','sandeep@ridosports.com','sidhant@ridosports.com'])
             //->cc('sandeep@ridosports.com')
			//->bcc('sidhant@ridosports.com')
            //->cc(['sandeep@ridosports.com','sidhant@ridosports.com'])
			
            ->send(new ContactUsFormMail($contactData));

        // Send thank-you email to the user
        Mail::to($contactData['email'])->send(new ThankYouMail());

        // Return a response (redirect or JSON)
        return redirect()->back()->with('status', 'Your message has been sent successfully!');
    }
    
    
     public function validateReCaptcha($recaptchaResponse)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $recaptchaResponse
        ]);

        $result = $response->json();
        return $result['success'] ?? false;
    }
}
