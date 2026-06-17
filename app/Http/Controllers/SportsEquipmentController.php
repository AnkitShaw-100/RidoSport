<?php

namespace App\Http\Controllers;

use App\Models\SportsEquipment;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SportsEquipmentController extends Controller
{
    /**
     * Display a list of all sports_equipment_list.
     */
    public function index()
    {
        $sports_equipment_list = SportsEquipment::all();
        return view('sports_equipment.equipment_list.index', compact('sports_equipment_list'));
    }

    /**
     * Show the form for creating a new sports equipment name.
     */
    public function create()
    {
        return view('sports_equipment.equipment_list.create');
    }

    /**
     * Store a newly created service or sublist in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:sports_equipment,slug',
            'url' => 'nullable|string|max:255|unique:sports_equipment,url',
        ]);

        // Create the sports equipment
        $sports_equipment_list = new SportsEquipment();
        $sports_equipment_list->name = $request->name;

        // Store the slug WITHOUT the full path
        $sports_equipment_list->slug = $request->slug 
            ? Str::slug($request->slug) // Use the provided slug or generate one
            : Str::slug($request->name);

        // Generate the URL based on the slug, adding the full path
        $sports_equipment_list->url = $request->url 
            ? $request->url 
            : route('equipment.show', ['slug' => $sports_equipment_list->slug]);

        // Save the equipment
        $sports_equipment_list->save();

        // Redirect with success message
        return redirect()->route('sports-equipment-list.index')
            ->with('success', 'Sports Equipment created successfully.');
    }


    // public function show($slug)
    // {
    //     // Fetch the equipment by the slug from the database
    //     $sports_equipment = SportsEquipment::where('slug', $slug)->firstOrFail();

    //     $equipments = Equipment::where('sports_equipment_id', $sports_equipment->id)->get();
    
    //     // Set the page title for frontend display
    //     $pageTitle = $sports_equipment->name;
    
    //     // Set the correct frontend route
    //     $pageRoute = route('equipment.show', ['slug' => $slug]);
    
    //     // Return the view for the sports equipment details
    //     return view('frontend.products.sports_equipment.index', compact('pageTitle', 'pageRoute', 'equipments'));
    // }
    public function show($slug)
{
    // Debugging: Log the slug received
    \Log::info("Received slug: {$slug}");

    // Fetch the equipment by the slug from the database
    $sports_equipment = SportsEquipment::where('slug', $slug)->firstOrFail();
    
    // Check if the equipment is found
    if (!$sports_equipment) {
        return redirect()->route('sports-equipment-list.index')->with('error', 'Equipment not found.');
    }
    
    $equipments = Equipment::where('sports_equipment_id', $sports_equipment->id)->get();

    // Set the page title for frontend display
    $pageTitle = $sports_equipment->name;

    // Set the correct frontend route
    $pageRoute = route('equipment.show', ['slug' => $slug]);

    // Return the view for the sports equipment details
    return view('frontend.products.sports_equipment.index', compact('pageTitle', 'pageRoute', 'equipments'));
}


    /**
     * Show the form for editing the specified service.
     */
    public function edit($id)
    {
    

        // Fetch a single sports equipment by ID
        $sports_equipment_list = SportsEquipment::findOrFail($id);

        // Pass the single model instance to the view
        return view('sports_equipment.equipment_list.edit', compact('sports_equipment_list'));
    }

    /**
     * Update the specified service in the database.
     */
    public function update(Request $request, $id)
    {
        // Find the sports equipment by ID
        $sports_equipment_list = SportsEquipment::findOrFail($id);
    
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            // Ensure slug is unique, but exclude the current record from the uniqueness check
            'slug' => 'nullable|string|max:255|unique:sports_equipment,slug,' . $id,
            // Ensure URL is unique, but exclude the current record from the uniqueness check
            'url' => 'nullable|string|max:255|unique:sports_equipment,url,' . $id,
        ]);
    
        // Update the name
        $sports_equipment_list->name = $request->name;
    
        // Update the slug (keep it without the full path)
        $sports_equipment_list->slug = $request->slug 
            ? Str::slug($request->slug)  // Use the provided slug or generate one from name
            : Str::slug($request->name);
    
        // Update the URL or generate it dynamically
        $sports_equipment_list->url = $request->url 
            ? $request->url 
            : route('sports-equipment.show', ['slug' => $sports_equipment_list->slug]);
    
        // Save the updated data
        $sports_equipment_list->save();
    
        // Redirect back with a success message
        return redirect()->route('sports-equipment-list.index')->with('success', 'Sports Equipment updated successfully.');
    }
    
    /**
     * Remove the specified service from the database.
     */
    public function destroy($id)
    {
        $sports_equipment_list = SportsEquipment::findOrFail($id);
        $sports_equipment_list->delete(); 
        return redirect()->route('sports-equipment-list.index')->with('success', 'Service deleted successfully.');
    }
}
