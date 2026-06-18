<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactUsFormController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductCardShowController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ServiceListController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SportsEquipmentController;
use App\Http\Controllers\DownloadCourtController;


//Clear Cache Config Route 
Route::get('/clear',function(){
    return view('frontend.home.cache-manage');
})->name('clear');
Route::get('/clear-config-cache', [CacheController::class, 'clearConfigCache'])->name('clear-config-cache');
Route::get('/clear-route-cache', [CacheController::class, 'clearRouteCache'])->name('clear-route-cache');
Route::get('/clear-all-caches', [CacheController::class, 'clearAllCaches'])->name('clear-all-caches');

// Main Routes Group
Route::group([], function () {
    // Public Pages Routes
    Route::prefix('/')->group(function () {
        Route::get('/', [FrontEndController::class, 'home'])->name('home');
        Route::get('/about-us', [FrontEndController::class, 'aboutUs'])->name('about-us');
        Route::get('/contact-us', [FrontEndController::class, 'contactUs'])->name('contact-us');
        Route::post('/contact-us', [ContactUsFormController::class, 'store'])->name('contact-store');

        // Gallery Page Routes
        Route::prefix('gallery')->group(function () {
            Route::get('/images', [FrontEndController::class, 'image_gallery'])->name('image-gallery');
            Route::get('/videos', [FrontEndController::class, 'video_gallery'])->name('video-gallery');
        });

        // Blog Page Routes
        Route::prefix('blog')->group(function () {
            Route::get('/', [FrontEndController::class, 'blog'])->name('blog');
            Route::get('/add', [BlogController::class, 'add'])->name('blog.add');
            Route::get('/{blog:slug}', [FrontEndController::class, 'blogDetails'])->name('blog-details');
        });
    });


        
    Route::get('sports-equipment/{slug}', [SportsEquipmentController::class, 'show'])->name('equipment.show');

    Route::prefix('services')->group(function () {
        // Route for the main service
        Route::get('/{slug}', [ServiceListController::class, 'show'])->name('service.show');
    
        // Route for sub-services under a parent service
        Route::get('/{parentSlug}/{subSlug}', [ServiceListController::class, 'showSubService'])->name('subservice.show');

    });
    
    Route::prefix('/design-court')->group(function () {

        Route::get('/', [FrontEndController::class, 'design_court'])->name('design-court');

        // Array of courts
        $courts = [
            'badminton-court',
            'basketball-court',
            'futsal-court',
            'handball-court',
            'tennis-court',
            'volleyball-court',
            'pickle-ball-court',
            'padel-court'
        ];
    
        // Loop through courts array to define routes
        foreach ($courts as $court) {
            // Remove the _court suffix when mapping to the controller method
            Route::get("/$court", [FrontEndController::class, str_replace('-', '_', $court)])->name($court);
        }

        Route::post('/download-court',[DownloadCourtController::class,'store']);
    }); 

    // Products Routes
    Route::prefix('products')->group(function () {

        // Route for the main PRODUCT
        Route::get('/{slug}', [ProductListController::class, 'show'])->name('product.show');
    
        // Route for sub-PRODUCTs under a parent PRODUCT
        Route::get('/{parentSlug}/{subSlug}', [ProductListController::class, 'showSubProduct'])->name('subproduct.show');
    });




});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'store'])->name('admin.login.store');
});

// Group routes for authenticated admin users
Route::middleware(['admin'])->group(function () {
	
    Route::get('/dashboard', [ContactUsFormController::class, 'index'])->name('dashboard');
    Route::post('/contact/destroy/{id}', [ContactUsFormController::class, 'destroy'])->name('contact.destroy');
    Route::post('/court/destroy/{id}', [DownloadCourtController::class, 'destroy'])->name('court-query.destroy');
    

    // Home Banner Routes
    Route::prefix('admin/home-banner')->name('home-banner.')->group(function () {
        Route::get('/', [HomeBannerController::class, 'index'])->name('index');
        Route::get('/create', [HomeBannerController::class, 'create'])->name('create');
        Route::post('/create', [HomeBannerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [HomeBannerController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [HomeBannerController::class, 'update'])->name('update');
        Route::delete('/{id}', [HomeBannerController::class, 'destroy'])->name('destroy');
    });

    // Client Routes
    Route::prefix('admin/client')->name('client.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/create', [ClientController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ClientController::class, 'update'])->name('update');
        Route::delete('/{id}', [ClientController::class, 'destroy'])->name('destroy');
    });

    // Certificate Routes
    Route::prefix('admin/certificate')->name('certificate.')->group(function () {
        Route::get('/', [CertificateController::class, 'index'])->name('index');
        Route::get('/create', [CertificateController::class, 'create'])->name('create');
        Route::post('/create', [CertificateController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CertificateController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CertificateController::class, 'update'])->name('update');
        Route::delete('/{id}', [CertificateController::class, 'destroy'])->name('destroy');
    });

    // Testimonial Routes
    Route::prefix('admin/testimonial')->name('testimonial.')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('create');
        Route::post('/create', [TestimonialController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [TestimonialController::class, 'update'])->name('update');
        Route::delete('/{id}', [TestimonialController::class, 'destroy'])->name('destroy');
    });

    // Gallery Image Routes
    Route::prefix('admin/gallery/image')->name('gallery.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('/create', [GalleryController::class, 'create'])->name('create');
        Route::post('/create', [GalleryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [GalleryController::class, 'update'])->name('update');
        Route::delete('/{id}', [GalleryController::class, 'destroy'])->name('destroy');
    });

    // Gallery Video Routes
    Route::prefix('admin/gallery/video')->name('video.')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('index');
        Route::get('/create', [VideoController::class, 'create'])->name('create');
        Route::post('/create', [VideoController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [VideoController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [VideoController::class, 'update'])->name('update');
        Route::delete('/{id}', [VideoController::class, 'destroy'])->name('destroy');
    });

    // Testimonial Routes
    Route::prefix('admin/product_card')->name('product_card.')->group(function () {
        Route::get('/', [ProductCardShowController::class, 'index'])->name('index');
        Route::get('/create', [ProductCardShowController::class, 'create'])->name('create');
        Route::post('/create', [ProductCardShowController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductCardShowController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductCardShowController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductCardShowController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/service_list')->name('service-list.')->group(function () {
        Route::get('/', [ServiceListController::class, 'index'])->name('index');
        Route::get('/create', [ServiceListController::class, 'create'])->name('create');
        Route::post('/create', [ServiceListController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ServiceListController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ServiceListController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServiceListController::class, 'destroy'])->name('destroy');
        // Route::get('services/{slug}', [ServiceListController::class, 'show'])->name('service.show'); // For main service
        // Route::get('services/{slug}/{subSlug}', [ServiceListController::class, 'showSubService'])->name('service.showSubService'); // For subservice
        
    });

    Route::prefix('admin/service_data')->name('project-data.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/create', [ProjectController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('destroy');        
    });

    // Admin Routes for Sports Equipment
    Route::prefix('admin/products/sports-equipments_list')->name('sports-equipment-list.')->group(function () {
        Route::get('/', [SportsEquipmentController::class, 'index'])->name('index'); 
        Route::get('/create', [SportsEquipmentController::class, 'create'])->name('create'); 
        Route::post('/create', [SportsEquipmentController::class, 'store'])->name('store'); 
        Route::get('/edit/{id}', [SportsEquipmentController::class, 'edit'])->name('edit'); 
        Route::post('/update/{id}', [SportsEquipmentController::class, 'update'])->name('update'); 
        Route::delete('/{id}', [SportsEquipmentController::class, 'destroy'])->name('destroy'); 
    });

    Route::prefix('admin/equipment_data')->name('equipment-data.')->group(function () {
        Route::get('/', [EquipmentController::class, 'index'])->name('index');
        Route::get('/create', [EquipmentController::class, 'create'])->name('create');
        Route::post('/create', [EquipmentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EquipmentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [EquipmentController::class, 'update'])->name('update');
        Route::delete('/{id}', [EquipmentController::class, 'destroy'])->name('destroy');        
    });

    Route::prefix('admin/product_list')->name('product-list.')->group(function () {
        Route::get('/', [ProductListController::class, 'index'])->name('index');
        Route::get('/create', [ProductListController::class, 'create'])->name('create');
        Route::post('/create', [ProductListController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductListController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductListController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductListController::class, 'destroy'])->name('destroy');
        Route::get('products/{slug}', [ProductListController::class, 'show'])->name('product.show'); // For main product
        Route::get('products/{slug}/{subSlug}', [ProductListController::class, 'showSubProduct'])->name('product.showSubProduct'); // For subproduct
        
    });

    Route::prefix('admin/product_data')->name('product-data.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');        
    });

    Route::prefix('admin/blog')->name('blog-data.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::get('/history', [BlogController::class, 'history'])->name('history');
        Route::post('/tinymce-image', [BlogController::class, 'uploadTinyMceImage'])->name('tinymce-image');
        Route::post('/create', [BlogController::class, 'store'])->name('store');
        Route::get('/view/{id}', [BlogController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BlogController::class, 'update'])->name('update');
        Route::delete('/{id}', [BlogController::class, 'destroy'])->name('destroy');
    });

});

// Profile Routes with auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__.'/auth.php';











        

       
