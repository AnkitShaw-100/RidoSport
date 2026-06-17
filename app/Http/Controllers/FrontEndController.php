<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Video;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    // Method for home page
    public function home()
    {
        return view('frontend.home.index');
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
        return view('frontend.blogs.index',compact('pageTitle', 'pageRoute'));
    }

    // Method for Blog Details page
    public function blogDetails()
    {   
        $pageTitle = 'Blog Details';
        $pageRoute = route('blog-details');
        return view('frontend.blogs.blog_details',compact('pageTitle', 'pageRoute'));
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
        return view('frontend.design-court.error'); // Adjust the view path as needed
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
    