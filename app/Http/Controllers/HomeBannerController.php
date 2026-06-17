<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $banner = HomeBanner::all();
        return view('home.home-banner.index', compact('banner'));
    }

    public function create()
    {
        return view('home.home-banner.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'tagline' => 'max:50',
            'video_url' => 'required|file|mimes:mp4|max:50960', // Video upload validation
        ]);

        // Handle the video upload
        $video = $request->file('video_url');
        
        // Generate a unique filename
        $filename = time() . '.' . $video->getClientOriginalExtension();
        
        // Store the video file in the 'banners' directory within the public disk
        $path = public_path('banners');
        $video->move($path, $filename);

        // Create the banner record
        HomeBanner::create([
            'tagline' => $request->input('tagline'),
            'video_url' => 'banners/' .$filename,  // Save the path relative to the public disk
        ]);

        return redirect()->route('home-banner.index')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);
        return view('home.home-banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = HomeBanner::findOrFail($id);
    
        // Validate the request data
        $request->validate([
            'tagline' => 'max:50',
            'video_url' => 'nullable|file|mimes:mp4|max:50960', // Video is optional
        ]);
    
        // Update the banner attributes
        $banner->tagline = $request->input('tagline');
    
        // Handle the video upload if a new video is provided
        if ($request->hasFile('video_url')) {
            // Get the old video path
            $oldVideoPath = public_path('storage/' . $banner->video_url);
    
            // Check if the old video exists and delete it
            if ($banner->video_url && file_exists($oldVideoPath)) {
                unlink($oldVideoPath); // Delete the old video
            }
    
            // Store the new video file

            $video = $request->file('video_url');
        
            // Generate a unique filename
            $filename = time() . '.' . $video->getClientOriginalExtension();
            
            // Store the video file in the 'banners' directory within the public disk
            $path = public_path('banners');
            $video->move($path, $filename);
    
            // Update the video path in the banner
            $banner->video_url= 'banners/' .$filename;
        }
    
        // Save the updated banner
        $banner->save();
    
        return redirect()->route('home-banner.index')->with('success', 'Banner updated successfully.');
    }
    

    public function destroy($id)
    {
        $banner = HomeBanner::findOrFail($id);

        // Delete the video file if it exists
        if ($banner) {
            $path = public_path($banner->video_url);

            if (file_exists($path)) {
                if (unlink($path)) {
                    // File successfully deleted
                    $banner->delete();
                    return redirect()->route('home-banner.index')->with('success', 'Video deleted successfully.');
                } else {
                    return redirect()->route('home-banner.index')->with('failure', 'Failed to delete the video.');
                }
            } else {
                return redirect()->route('home-banner.index')->with('failure', 'File not found.');
            }
        }

        return redirect()->route('home-banner.index')->with('failure', 'Banner not found.');
    }


}
