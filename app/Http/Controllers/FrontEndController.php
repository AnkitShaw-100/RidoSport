<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FrontEndController extends Controller
{
    // Method for home page
    public function home()
    {
        $blogs = Schema::hasTable('blogs')
            ? $this->publishedBlogsQuery()->latest()->limit(3)->get()
            : collect();

        return view('frontend.home.index', compact('blogs'));
    }

    // Method for About Us page
    public function aboutUs()
    {
        $pageTitle = 'About Us';
        $pageRoute = route('about-us');
        return view('frontend.about.index',compact('pageTitle', 'pageRoute'));  
    }

    // Method for Blog page
    public function blog()
    {
        $pageTitle = 'Blogs';
        $pageRoute = route('blog');
        $blogs = Schema::hasTable('blogs')
            ? $this->publishedBlogsQuery()->latest()->paginate(9)
            : collect();

        return view('frontend.blogs.index',compact('pageTitle', 'pageRoute', 'blogs'));
    }

    // Method for Blog Details page
    public function blogDetails(Blog $blog)
    {   
        if (Schema::hasColumn('blogs', 'status') && $blog->status !== 'published') {
            abort(404);
        }

        $pageTitle = 'Blog Details';
        $pageRoute = route('blog-details', $blog);
        $recentBlogs = $this->publishedBlogsQuery()
            ->latest()
            ->where('id', '!=', $blog->id)
            ->limit(3)
            ->get();

        return view('frontend.blogs.blog_details',compact('pageTitle', 'pageRoute', 'blog', 'recentBlogs'));
    }

    private function publishedBlogsQuery()
    {
        return Blog::query()->when(
            Schema::hasColumn('blogs', 'status'),
            fn ($query) => $query->where('status', 'published')
        );
    }

    // Method for Gallery page
    public function image_gallery(){
        $pageTitle = 'Image Gallery';
        $pageRoute = route('image-gallery');
        $images = Gallery::orderBy('created_at', 'desc')->get(); 
        return view('frontend.gallery.image',compact('pageTitle', 'pageRoute','images'));
    }

    public function video_gallery(){
        $pageTitle = 'Video Gallery';
        $pageRoute = route('video-gallery');
        $videos = Video::orderBy('created_at', 'desc')->get();
        return view('frontend.gallery.video',compact('pageTitle', 'pageRoute','videos'));
    }

    // Method for Contact Us page
    public function contactUs()
    {
        $pageTitle = 'Contact Us';
        $pageRoute = route('contact-us');
        return view('frontend.contact.index',compact('pageTitle', 'pageRoute'));
    }
    
    //courts

    public function design_court()
    {
        return view('frontend.design-court.error'); // Adjust the view path as needed
    }
// Method for Badminton court
    public function badminton_court()
    {
        return view('frontend.design-court.badminton'); // Adjust the view path as needed
    }

    // Method for Basketball court
    public function basketball_court()
    {
        return view('frontend.design-court.basketball'); // Adjust the view path as needed
    }

    // Method for Futsal court
    public function futsal_court()
    {
        return view('frontend.design-court.futsal'); // Adjust the view path as needed
    }

    // Method for Handball court
    public function handball_court()
    {
        return view('frontend.design-court.handball'); // Adjust the view path as needed
    }

    // Method for Tennis court
    public function tennis_court()
    {
        return view('frontend.design-court.tennis'); // Adjust the view path as needed
    }

    // Method for Volleyball court
    public function volleyball_court()
    {
        return view('frontend.design-court.volleyball'); // Adjust the view path as needed
    }

    // Method for Volleyball court
    public function padel_court()
    {
        return view('frontend.design-court.padel'); // Adjust the view path as needed
    }
    // Method for Volleyball court
    public function pickle_ball_court()
    {
        return view('frontend.design-court.pickle-ball'); // Adjust the view path as needed
    }
}
    
