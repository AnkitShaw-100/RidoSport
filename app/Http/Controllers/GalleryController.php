<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::all();
        // Log::info('Gallery data:', $gallery->toArray()); // Log gallery data for debugging
        return view('gallery.index', compact('gallery'));
    }
    
    

    public function create()
    {   
        return view('gallery.create');
    }
    public function store(Request $request) 
    {
        // Validate the request data
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:10240',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            // Generate a unique filename
            $filename = time() . '.' . $image->getClientOriginalExtension();
    
            // Define the path where the image will be stored (directly in the public folder)
            $path = public_path('gallery');
    
            // Make sure the directory exists
            if (!file_exists($path)) {
                mkdir($path, 0777, true);  // Create the directory if it doesn't exist
            }
    
            // Move the uploaded file to the public/gallery directory
            $image->move($path, $filename);
    
            // Save the file path in the database (relative path for easy access in views)
            Gallery::create([
                'caption' => $request->input('caption'),
                'image_path' => 'gallery/' . $filename,  // Save relative path
            ]);
        } else {
            // Handle the case where no image is uploaded
            return back()->withErrors(['image' => 'Image is required.']);
        }
    
        return redirect()->route('gallery.index')->with('success', 'Image created successfully.');
    }
    
    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        // Find the gallery by ID or fail
        $gallery = Gallery::findOrFail($id);
    
        // Validate the form inputs
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        ]);
    
        // Update the gallery's name
        $gallery->caption = $request->input('caption');
    
        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Get the old image path
            $oldImagePath = public_path($gallery->image_path);
    
            // Check if the old image exists and delete it
            if ($gallery->image_path && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old image
            }
    
            // Store the new image in the 'gallery' directory within the public folder
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('gallery'), $filename);
    
            // Update the image path in the database
            $gallery->image_path = 'gallery/' . $filename;
        }
    
        // Save the updated client data
        $gallery->save();
    
        // Redirect back to the client list with a success message
        return redirect()->route('gallery.index')->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
    
        if ($gallery) {
            // Check if the file exists and delete it
            $path = public_path($gallery->image_path);
    
            if (file_exists($path)) {
                if (unlink($path)) {
                    // File successfully deleted
                    $gallery->delete();
                    return redirect()->route('gallery.index')->with('success', 'Image deleted successfully.');
                } else {
                    return redirect()->route('gallery.index')->with('failure', 'Failed to delete the image.');
                }
            } else {
                return redirect()->route('gallery.index')->with('failure', 'File not found.');
            }
        }
    
        return redirect()->route('gallery.index')->with('failure', 'Image not found.');
    }
    
}