<?php

namespace App\Http\Controllers;

use App\Models\DownloadCourt;
use Illuminate\Http\Request;

class DownloadCourtController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'requirement' => 'required|string',
            'city' => 'required|string|max:255',
            'message' => 'required|string',
            'court' => 'required|string'
        ]);
    
        // Save data in the database
        DownloadCourt::create($validatedData);
    
        return response()->json(['success' => true]); // Ensure a JSON response is sent back
    }
	
	    public function destroy($id){
        $contactData = DownloadCourt::find($id);
        $contactData->delete();
        return redirect()->back()->with('success', 'Deleted successfully.');
    }
    
}
