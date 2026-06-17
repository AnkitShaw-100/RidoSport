<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    // Display a listing of certificates
    public function index()
    {
        $certificates = Certificate::paginate(5);
        return view('home.certificate.index', compact('certificates'));
    }

    // Show the form for creating a new certificate (if using views)
    public function create()
    {
        return view('home.certificate.create');
    }

    // Store a newly created certificate in the database
    public function store(Request $request) 
    {
        // Validate the request data
        $request->validate([
            'certified_by_company_name' => 'required|string|max:255',
            'certified_by_logo' => 'required|image|mimes:png,webp|max:2048', // Image validation
            'certified_for' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
        ]);
    
        // Handle the image upload for the certified_by_logo field
        if ($request->hasFile('certified_by_logo')) {
            $logo = $request->file('certified_by_logo');
            
            // Generate a unique filename for the logo
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            
            // Define the path where the logo will be stored (in the public/certificates directory)
            $path = public_path('certificates');
    
            // Create the directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            // Move the uploaded file to the public/certificates directory
            $logo->move($path, $filename);
    
            // Save the file path and other form data in the database
            Certificate::create([
                'certified_by_company_name' => $request->input('certified_by_company_name'),
                'certified_by_logo' => 'certificates/' . $filename,  // Save relative path to the logo
                'certified_for' => $request->input('certified_for'),
                'product_name' => $request->input('product_name'),
            ]);
    
        } else {
            // Handle the case where no logo is uploaded
            return back()->withErrors(['certified_by_logo' => 'Logo image is required.']);
        }
    
        // Redirect back with a success message
        return redirect()->route('certificate.index')->with('success', 'Certificate created successfully.');
    }
    

    // Show the form for editing the specified certificate (if using views)
    public function edit($id)
    {
        $certificate = Certificate::find($id);
        return view('home.certificate.edit', compact('certificate'));
    }

    // Update the specified certificate in the database
    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        // Validate the form inputs
        $validatedData = $request->validate([
            'certified_by_company_name' => 'required|string|max:255',
            'certified_for' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'certified_by_logo' => 'nullable|mimes:png,webp|max:2048', // Logo image is optional
        ]);

        // Update the certificate's basic fields
        $certificate->certified_by_company_name = $request->input('certified_by_company_name');
        $certificate->certified_for = $request->input('certified_for');
        $certificate->product_name = $request->input('product_name');

        // Handle the logo image upload if a new one is provided
        if ($request->hasFile('certified_by_logo')) {
            // Get the old logo path
            $oldLogoPath = public_path($certificate->certified_by_logo);

            // Check if the old logo exists and delete it
            if ($certificate->certified_by_logo && file_exists($oldLogoPath)) {
                unlink($oldLogoPath); // Delete the old logo image
            }

            // Store the new logo in the 'certificates' directory within the public folder
            $logo = $request->file('certified_by_logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('certificates'), $filename);

            // Update the logo path in the database
            $certificate->certified_by_logo = 'certificates/' . $filename;
        }

        // Save the updated certificate data
        $certificate->save();

        // Redirect back to the certificate list with a success message
        return redirect()->route('certificate.index')->with('success', 'Certificate updated successfully.');
    }


    // Remove the specified certificate from the database
    public function destroy($id)
    {
        $certificate = Certificate::find($id);
        if ($certificate) {
            // Check if the file exists and delete it
            $path = public_path($certificate->certified_by_logo);
    
            if (file_exists($path)) {
                if (unlink($path)) {
                    // File successfully deleted
                    $certificate->delete();
                    return redirect()->route('certificate.index')->with('success', 'Certificate deleted successfully.');
                } else {
                    return redirect()->route('certificate.index')->with('failure', 'Failed to delete the image.');
                }
            } else {
                return redirect()->route('certificate.index')->with('failure', 'File not found.');
            }
        }
    
        return redirect()->route('certificate.index')->with('failure', 'Certificate not found.');
    }
}
