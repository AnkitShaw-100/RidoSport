<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\SportsEquipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{

    public function index()
    {
        // Fetch paginated projects with their related subservice
        $equipments = Equipment::with('sportsEquipment')->paginate(5); // 10 equipments per page

        return view('sports_equipment.equipment_data.index', compact('equipments'));
    }


    // Show the form for creating a new resource
    public function create()
    {
        // Fetch subservices to display in a select dropdown
        $sportsEquipment = SportsEquipment::all();

        return view('sports_equipment.equipment_data.create', compact('sportsEquipment'));
    
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sportsEquipment_id' => 'required|exists:sports_equipment,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

    
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            // Define the path where the images will be stored
            $path = public_path('equipments');
    
            // Create the directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            // Generate a unique filename for  image
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Move the uploaded file to the specified directory
            $image->move($path, $filename);
            
            // Store the relative file path for database storage
            $imagePath = 'equipments/' . $filename;

        }
    
        // Store project data
        Equipment::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'sports_equipment_id' => $request->input('sportsEquipment_id'),
            'image' => $imagePath, 
        ]);
    
        return redirect()->route('equipment-data.index')->with('success', 'Equipment created successfully.');
    }    


    public function edit($id)
    {
        // Find the project by ID
        $equipment = Equipment::findOrFail($id);
        $sportsEquipment = SportsEquipment::all();

        return view('sports_equipment.equipment_data.edit', compact('equipment', 'sportsEquipment'));
    }

    public function update(Request $request, $id)
    {
        // Find the existing equipment
        $equipment = Equipment::findOrFail($id);
    
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sports_equipment_id' => 'required|exists:sports_equipment,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Allow null and restrict image types
        ]);
    
        // Update the equipment's basic fields
        $equipment->name = $request->input('name');
        $equipment->description = $request->input('description');
        $equipment->sports_equipment_id = $request->input('sports_equipment_id');
    
        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Get the old image path
            $oldImagePath = public_path($equipment->image);

            // Check if the old image exists and delete it
            if ($equipment->image && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old image
            }

            // Store the new image
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('equipments'), $filename);

            // Update the image path in the database
            $equipment->image = 'equipments/' . $filename;
        }
    
        // Save the updated equipment
        $equipment->save();
    
        // Redirect back to the equipment list with a success message
        return redirect()->route('equipment-data.index')->with('success', 'Equipment updated successfully.');
    }
       


    public function destroy($id)
    {
        // Find the project or fail with a 404 response
        $equipment = Equipment::findOrFail($id);
    
        // Delete associated images from the public directory
        if (!empty($equipment->image)) {
            $filePath = public_path($equipment->image); // Get the full path of the image
            if (file_exists($filePath)) { // Check if the file exists before attempting to delete
                unlink($filePath); // Delete the file
            }
        }
    
        // Delete the $equipment
        $equipment->delete();
    
        // Redirect back to the $equipment index with a success message
        return redirect()->route('equipment-data.index')->with('success', 'Equipment deleted successfully.');
    }
    

}
