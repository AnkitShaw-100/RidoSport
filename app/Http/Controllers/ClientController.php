<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(10); // 10 clients per page
        return view('home.client.index', compact('clients'));
        
    }

    public function create()
    {   
        return view('home.client.create');
    }
    public function store(Request $request) 
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,webp|max:2048',
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Generate a unique filename
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Define the path where the image will be stored (directly in the public folder)
            $path = public_path('clients');
    
            // Make sure the directory exists
            if (!file_exists($path)) {
                mkdir($path, 0777, true);  // Create the directory if it doesn't exist
            }
    
            // Move the uploaded file to the public/clients directory
            $image->move($path, $filename);
    
            // Save the file path in the database (relative path for easy access in views)
            Client::create([
                'name' => $request->input('name'),
                'image_path' => 'clients/' . $filename,  // Save relative path
            ]);
        } else {
            // Handle the case where no image is uploaded
            return back()->withErrors(['image' => 'Image is required.']);
        }
    
        return redirect()->route('client.index')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('home.client.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        // Find the client by ID or fail
        $client = Client::findOrFail($id);
    
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,webp|max:2048', // Image is optional
        ]);
    
        // Update the client's name
        $client->name = $request->input('name');
    
        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Get the old image path
            $oldImagePath = public_path($client->image_path);
    
            // Check if the old image exists and delete it
            if ($client->image_path && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old image
            }
    
            // Store the new image in the 'clients' directory within the public folder
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('clients'), $filename);
    
            // Update the image path in the database
            $client->image_path = 'clients/' . $filename;
        }
    
        // Save the updated client data
        $client->save();
    
        // Redirect back to the client list with a success message
        return redirect()->route('client.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::find($id);
    
        if ($client) {
            // Check if the file exists and delete it
            $path = public_path($client->image_path);
    
            if (file_exists($path)) {
                if (unlink($path)) {
                    // File successfully deleted
                    $client->delete();
                    return redirect()->route('client.index')->with('success', 'Client deleted successfully.');
                } else {
                    return redirect()->route('client.index')->with('failure', 'Failed to delete the image.');
                }
            } else {
                return redirect()->route('client.index')->with('failure', 'File not found.');
            }
        }
    
        return redirect()->route('client.index')->with('failure', 'Client not found.');
    }
    
}
