<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the videos.
     */
    public function index()
    {
        $videos = Video::paginate(10); // Use pagination for efficiency
        return view('video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new video.
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created video in the database.
     */
    public function store(Request $request) 
    {
        // Validate the request data
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'url' => 'required|url',
        ]);
    
        // Extract the YouTube video ID using a regex
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $request->url, $matches);
    
        if (isset($matches[1])) {
            $youtubeId = $matches[1];
            
            // Store the video with the YouTube ID
            Video::create([
                'caption' => $request->caption,
                'url' => $youtubeId, // Save only the video ID
            ]);
    
            return redirect()->route('video.index')->with('success', 'Video created successfully.');
        } else {
            return redirect()->back()->withErrors(['url' => 'Invalid YouTube URL.'])->withInput();
        }
    }
    
    /**
     * Show the form for editing the specified video.
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id); // Automatically handle 404 if not found
        return view('video.edit', compact('video'));
    }

    /**
     * Update the specified video in the database.
     */
    public function update(Request $request, $id)
    {
        // Find the Video by ID or fail
        $video = Video::findOrFail($id);
    
        // Validate the form inputs
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'url' => 'nullable|url',
        ]);
    
        // If a new URL is provided, extract the YouTube video ID
        if ($request->url) {
            preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $request->url, $matches);
            
            if (isset($matches[1])) {
                $video->url = $matches[1]; // Save only the video ID
            } else {
                return redirect()->back()->withErrors(['url' => 'Invalid YouTube URL.'])->withInput();
            }
        }
    
        // Update the video's caption
        $video->caption = $request->caption;
    
        // Save the updated video data
        $video->save();
    
        // Redirect back to the video list with a success message
        return redirect()->route('video.index')->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified video from the database.
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id); // Automatically handle 404 if not found
        $video->delete();

        return redirect()->route('video.index')->with('success', 'Video deleted successfully.');
    }
}
