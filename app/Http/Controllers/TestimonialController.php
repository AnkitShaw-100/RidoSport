<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // Display a listing of testimonials
    public function index()
    {
        $testimonials = Testimonial::paginate(5);
        return view('home.testimonial.index', compact('testimonials'));
    }

    // Show the form for creating a new testimonial (if using views)
    public function create()
    {
        return view('home.testimonial.create');
    }

    // Store a newly created testimonial in the database
    public function store(Request $request) 
    {
        // Validate the request data
        $request->validate([
            'author_name' => 'required|string|max:25',
            'author_image' => 'required|image|max:10240',
            'author_designation' => 'required|string|max:255',
            'message' => 'required|string|max:350',
        ]);

        // Handle the image upload for the author_image field
        if ($request->hasFile('author_image')) {
            $testimonial_image = $request->file('author_image');
            
            // Generate a unique filename for the logo
            $filename = time() . '.' . $testimonial_image->getClientOriginalExtension();
            
            // Define the path where the logo will be stored (in the public/authors directory)
            $path = public_path('authors');
    
            // Create the directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            // Move the uploaded file to the public/authors directory
            $testimonial_image->move($path, $filename);
    
            // Save the file path and other form data in the database
            Testimonial::create([
                'author_name' => $request->input('author_name'),
                'author_image' => 'authors/' . $filename,  
                'author_designation' => $request->input('author_designation'),
                'message' => $request->input('message'),
            ]);
    
        } else {
            // Handle the case where no logo is uploaded
            return back()->withErrors(['author_image' => 'Author image is required.']);
        }
        

        // Redirect back with a success message
        return redirect()->route('testimonial.index')->with('success', 'Testimonial created successfully.');
    }
    

    // Show the form for editing the specified testimonial (if using views)
    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('home.testimonial.edit', compact('testimonial'));
    }

    // Update the specified testimonial in the database
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Validate the form inputs
        $request->validate([
            'author_name' => 'required|string|max:25',
            'author_image' => 'image|max:10240',
            'author_designation' => 'required|string|max:255',
            'message' => 'required|string|max:350'
        ]);

        // Update the testimonial's basic fields
        $testimonial->author_name = $request->input('author_name');
        $testimonial->author_designation = $request->input('author_designation');
        $testimonial->message = $request->input('message');

        if ($request->hasFile('author_image')) {
            // Get the old logo path
            $oldauthorpath = public_path($testimonial->author_image);

            // Check if the old logo exists and delete it
            if ($testimonial->author_image && file_exists($oldauthorpath)) {
                unlink($oldauthorpath); // Delete the old logo image
            }

            // Store the new logo in the 'authors' directory within the public folder
            $logo = $request->file('author_image');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('authors'), $filename);

            // Update the logo path in the database
            $testimonial->author_image = 'authors/' . $filename;
        }

        // Save the updated testimonial data
        $testimonial->save();

        // Redirect back to the testimonial list with a success message
        return redirect()->route('testimonial.index')->with('success', 'Testimonial updated successfully.');
    }


    // Remove the specified testimonial from the database
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            $testimonial->delete();
            return redirect()->route('testimonial.index')->with('success', 'Testimonial deleted successfully.');
        }
        return redirect()->route('testimonial.index')->with('failure', 'Testimonial not found.');
    }
}

