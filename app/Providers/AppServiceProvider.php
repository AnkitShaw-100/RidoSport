<?php

namespace App\Providers;

use App\Models\Certificate;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\HomeBanner;
use App\Models\ProductCardShow;
use App\Models\ProductList;
use App\Models\ServiceList;
use App\Models\SportsEquipment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Testimonial;
use App\Models\Video;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        View::composer('frontend.banner.index', function ($view) {
            $banner = HomeBanner::latest()->first();
            $view->with('banner', $banner);
        });

        View::composer('frontend.clients.index', function ($view) {
            $clients = Client::all();
            $view->with('clients', $clients);
        });

        View::composer('frontend.certificates.index', function ($view) {
            $certificates = Certificate::orderBy('created_at', 'desc')->get();
            $view->with('certificates', $certificates);
        });

        View::composer('frontend.testimonials.index', function ($view) {
            $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
            $view->with('testimonials', $testimonials);
        });

        View::composer('frontend.gallery.index', function ($view) {
            $images = Gallery::count(); 
            $videos = Video::count(); 
        
            $view->with([
                'images' => $images,
                'videos' => $videos,
            ]);
        });

        
        View::composer('frontend.products.index', function ($view) {
            $product_cards = ProductCardShow::all();
            $view->with('product_cards', $product_cards);
        });


        // Services and sub-services data (for dynamic services in the header)
        View::composer('*', function ($view) { // Share with all views
            $services = ServiceList::whereNull('parent_id') // Get all main services (without a parent)
                                  ->with('subservices') // Eager load the sub-services
                                  ->get();
            $view->with('services', $services);
        });

        View::composer('*', function ($view) {
            // Fetch sub-services (services with a parent) and limit to 5 results
            $subservicesFooter = ServiceList::whereNotNull('parent_id') // Get sub-services (services with a parent)
                                      ->with('parentService')
                                      ->limit(6) // Limit the results to 5
                                      ->get();
        
            // Share the subservices data with all views
            $view->with('subservicesFooter', $subservicesFooter);
        });
        

        // Services and sub-services data (for dynamic services in the header)
        View::composer('frontend.layout.header', function ($view) { 
            $sports_equipment_list = SportsEquipment::all(); // Retrieve all sports equipment
            $view->with('sports_equipment_list', $sports_equipment_list); // Share it with all views
        });
        View::composer('frontend.layout.header1', function ($view) { 
            $sports_equipment_list = SportsEquipment::all(); // Retrieve all sports equipment
            $view->with('sports_equipment_list', $sports_equipment_list); // Share it with all views
        });

        // Services and sub-products data (for dynamic products in the header)

        View::composer('frontend.layout.header', function ($view) { // Share with all views
            $products = ProductList::whereNull('parent_id') // Get all main products (without a parent)
                                  ->with('subproducts') // Eager load the sub-products
                                  ->get();
            $view->with('products', $products);
        });

        
        View::composer('frontend.layout.header1', function ($view) { // Share with all views
            $products = ProductList::whereNull('parent_id') // Get all main products (without a parent)
                                  ->with('subproducts') // Eager load the sub-products
                                  ->get();
            $view->with('products', $products);
        });
        
        View::composer('frontend.layout.footer', function ($view) {
            // Fetch products that don't have any sub-products (no children) or are sub-products themselves
            $products = ProductList::whereDoesntHave('subproducts') // Get products that don't have children
                                   ->orWhereNotNull('parent_id') // Also get sub-products (that have a parent)
                                   ->with('parentProduct')
                                   ->limit(5)
                                   ->get();
        
            // Share the filtered products with the view
            $view->with('products', $products);
        });
        
        
    
    }
}
