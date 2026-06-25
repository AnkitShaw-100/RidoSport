<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function download(Certificate $certificate)
    {
        if ($certificate->certificate_pdf) {
            $pdfPath = public_path($certificate->certificate_pdf);

            if (file_exists($pdfPath)) {
                return response()->download($pdfPath, $this->certificateFilename($certificate), [
                    'Content-Type' => 'application/pdf',
                ]);
            }
        }

        return response($this->buildCertificatePdf($certificate), 200, [
            'Content-Disposition' => 'attachment; filename="' . $this->certificateFilename($certificate) . '"',
            'Content-Type' => 'application/pdf',
        ]);
    }

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
            'certificate_pdf' => 'nullable|file|mimes:pdf|max:10240',
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

            $pdfPath = null;

            if ($request->hasFile('certificate_pdf')) {
                $pdf = $request->file('certificate_pdf');
                $pdfFilename = time() . '-certificate.' . $pdf->getClientOriginalExtension();
                $pdf->move($path, $pdfFilename);
                $pdfPath = 'certificates/' . $pdfFilename;
            }
    
            // Save the file path and other form data in the database
            Certificate::create([
                'certified_by_company_name' => $request->input('certified_by_company_name'),
                'certified_by_logo' => 'certificates/' . $filename,  // Save relative path to the logo
                'certificate_pdf' => $pdfPath,
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
            'certificate_pdf' => 'nullable|file|mimes:pdf|max:10240',
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

        if ($request->hasFile('certificate_pdf')) {
            $oldPdfPath = public_path($certificate->certificate_pdf);

            if ($certificate->certificate_pdf && file_exists($oldPdfPath)) {
                unlink($oldPdfPath);
            }

            $pdf = $request->file('certificate_pdf');
            $pdfFilename = time() . '-certificate.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('certificates'), $pdfFilename);

            $certificate->certificate_pdf = 'certificates/' . $pdfFilename;
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
                    $pdfPath = public_path($certificate->certificate_pdf);

                    if ($certificate->certificate_pdf && file_exists($pdfPath)) {
                        unlink($pdfPath);
                    }

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

    private function certificateFilename(Certificate $certificate): string
    {
        $name = preg_replace('/[^A-Za-z0-9]+/', '-', $certificate->certified_by_company_name . '-' . $certificate->product_name);
        $name = trim(strtolower($name), '-');

        return ($name ?: 'certificate') . '.pdf';
    }

    private function buildCertificatePdf(Certificate $certificate): string
    {
        $lines = [
            ['Rido Sports', 26, 72, 760],
            ['Certification Badge', 18, 72, 720],
            ['Certified By: ' . $certificate->certified_by_company_name, 14, 72, 660],
            ['Awarded For: ' . $certificate->certified_for, 14, 72, 630],
            ['Product: ' . $certificate->product_name, 14, 72, 600],
            ['This PDF was generated from the accreditation record displayed on the Rido Sports website.', 11, 72, 540],
        ];

        $content = '';

        foreach ($lines as [$text, $size, $x, $y]) {
            $content .= "BT /F1 {$size} Tf {$x} {$y} Td (" . $this->escapePdfText($text) . ") Tj ET\n";
        }

        $objects = [
            "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n",
            "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n",
            "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n",
            "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n",
            "5 0 obj\n<< /Length " . strlen($content) . " >>\nstream\n{$content}endstream\nendobj\n",
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $object) {
            $offsets[] = strlen($pdf);
            $pdf .= $object;
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n{$xrefOffset}\n%%EOF";

        return $pdf;
    }

    private function escapePdfText(string $text): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\(', '\)'], $text);
    }
}
