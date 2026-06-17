<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ServiceList; 
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        // Fetch paginated projects with their related subservice
        $projects = Project::with('subservice')->paginate(5); // 10 projects per page

        return view('services.service_data.index', compact('projects'));
    }


    // Show the form for creating a new resource
    public function create()
    {
        // Fetch subservices to display in a select dropdown
        $subservices = ServiceList::whereNotNull('parent_id')->get();


        return view('services.service_data.create', compact('subservices'));
    
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'subservice_id' => 'required|exists:service_lists,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

    
        // Handle image uploads and store image paths
        $imagePaths = [];
        if ($request->hasFile('images')) {
            $images = $request->file('images');
    
            // Define the path where the images will be stored
            $path = public_path('projects');
    
            // Create the directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            foreach ($images as $image) {
                // Generate a unique filename for each image
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Move the uploaded file to the specified directory
                $image->move($path, $filename);
                
                // Store the relative file path for database storage
                $imagePaths[] = 'projects/' . $filename;
            }
        }
    
        // Store project data
        Project::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'subservice_id' => $request->input('subservice_id'),
            'images' => json_encode($imagePaths), // Save the paths as JSON
        ]);
    
        return redirect()->route('project-data.index')->with('success', 'Project created successfully.');
    }    

    public function edit($id)
    {
        // Find the project by ID
        $project = Project::findOrFail($id);
        $subservices = ServiceList::whereNotNull('parent_id')->get();

        return view('services.service_data.edit', compact('project', 'subservices'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'subservice_id' => 'required|exists:service_lists,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'delete_images' => 'nullable|array',
        ]);

        $project = Project::findOrFail($id);
        $imagePaths = json_decode($project->images, true); // Existing images

        // Handle image deletion
        if ($request->has('delete_images')) {
            $deleteImages = $request->input('delete_images');

            // Loop through and delete the selected images
            foreach ($deleteImages as $deleteImage) {
                // Remove from file system
                if (file_exists(public_path($deleteImage))) {
                    unlink(public_path($deleteImage));
                }

                // Remove from the imagePaths array
                if (($key = array_search($deleteImage, $imagePaths)) !== false) {
                    unset($imagePaths[$key]);
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $path = public_path('projects');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Store new images
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);

                $imagePaths[] = 'projects/' . $filename;
            }
        }

        // Update the project with the new images array
        $project->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'subservice_id' => $request->input('subservice_id'),
            'images' => json_encode(array_values($imagePaths)), // Re-index the array to ensure it remains valid JSON
        ]);

        return redirect()->route('project-data.index')->with('success', 'Project updated successfully.');
    }


    public function destroy($id)
    {
        // Find the project or fail with a 404 response
        $project = Project::findOrFail($id);
    
        // Delete associated images from the public directory
        if (!empty($project->images)) {
            $images = json_decode($project->images, true);
    
            foreach ($images as $image) {
                $filePath = public_path($image); // Get the full path of the image
                if (file_exists($filePath)) { // Check if the file exists before attempting to delete
                    unlink($filePath); // Delete the file
                }
            }
        }
    
        // Delete the project
        $project->delete();
    
        // Redirect back to the project index with a success message
        return redirect()->route('project-data.index')->with('success', 'Project deleted successfully.');
    }
    

}