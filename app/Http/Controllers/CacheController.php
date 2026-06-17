<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Exception;

class CacheController extends Controller
{
    public function clearConfigCache()
    {
        try {
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            return redirect()->back()->with('status', 'Configuration cache cleared and re-cached successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to clear configuration cache: ' . $e->getMessage());
        }
    }

    public function clearRouteCache()
    {
        try {
            Artisan::call('route:clear');
            Artisan::call('route:cache');
            return redirect()->back()->with('status', 'Route cache cleared and re-cached successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to clear route cache: ' . $e->getMessage());
        }
    }

    public function clearAllCaches()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            Artisan::call('route:clear');
            Artisan::call('route:cache');
            return redirect()->back()->with('status', 'All caches cleared and re-cached successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to clear all caches: ' . $e->getMessage());
        }
    }


}
