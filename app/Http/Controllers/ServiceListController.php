<?php

namespace App\Http\Controllers;

use App\Models\ServiceList;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceListController extends Controller
{
    public function catalog()
    {
        $serviceGroups = ServiceList::whereNull('parent_id')
            ->with(['subServices.projects', 'projects'])
            ->orderBy('name')
            ->get();

        return view('frontend.services.catalog', compact('serviceGroups'));
    }

    public function categoryRange($slug)
    {
        $serviceGroup = ServiceList::where('slug', $slug)
            ->whereNull('parent_id')
            ->with(['subServices.projects', 'projects'])
            ->firstOrFail();

        $catalogItems = collect();

        if ($serviceGroup->projects->isNotEmpty() || $serviceGroup->subServices->isEmpty()) {
            $catalogItems->push($serviceGroup);
        }

        foreach ($serviceGroup->subServices as $subService) {
            $catalogItems->push($subService);
        }

        if ($catalogItems->count() === 1) {
            $item = $catalogItems->first();

            return redirect($item->parent_id
                ? route('subservice.show', [$serviceGroup->slug, $item->slug])
                : route('service.show', $item->slug));
        }

        return view('frontend.services.category_range', [
            'pageTitle' => $serviceGroup->name,
            'parentGroup' => $serviceGroup,
            'catalogItems' => $catalogItems,
        ]);
    }

    /**
     * Display a list of all services and their sublists.
     */
    public function index()
    {
        $services = ServiceList::whereNull('parent_id')->with('subservices')->get();
        return view('services.service_list.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('services.service_list.create');
    }

    /**
     * Store a newly created service or sublist in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'service_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_lists,slug',
            'url' => 'nullable|string|max:255|unique:service_lists,url',
            'sublist_items.*.name' => 'nullable|string|max:255',
            'sublist_items.*.slug' => 'nullable|string|max:255|unique:service_lists,slug',
            'sublist_items.*.url' => 'nullable|string|max:255|unique:service_lists,url',
        ]);
    
        // Create the main service
        $mainService = new ServiceList();
        $mainService->name = $request->service_name;
        $mainService->slug = $request->slug ?? Str::slug($request->service_name);
        $mainService->url = $request->url ?? route('service.show', $mainService->slug);
        $mainService->parent_id = null; // Main service has no parent
        $mainService->save();
    
        // Save sublist items if provided
        if ($request->has('sublist_items')) {
            foreach ($request->sublist_items as $sublist) {
                $subService = new ServiceList();
                $subService->name = $sublist['name'] ?? null; // Ensure name is nullable
                $subService->slug = $sublist['slug'] ?? Str::slug($subService->name); // Use sublist name if slug is missing
                
                // Construct the URL using the main service slug
                $subService->url = $sublist['url'] ?? route('subservice.show', [$mainService->slug, $subService->slug]);
                $subService->parent_id = $mainService->id; // Set the parent to the main service
                
                // Save the sublist service if it has a name
                if (!empty($subService->name)) {
                    $subService->save();
                }
            }
        }
    
        // Redirect back to the service list with a success message
        return redirect()->route('service-list.index')->with('success', 'Service and sublist created successfully.');
    }

    public function show($slug)
    {
        // Fetch the main service by slug
        $service = ServiceList::where('slug', $slug)
            ->with('subServices')
            ->firstOrFail();

        if ($service->subServices->isNotEmpty()) {
            return redirect()->route('service-category.show', $service->slug);
        }
        
        // Set the page title and route
        $pageTitle = $service->name;
        $pageRoute = route('service.show', $slug); // Generate the route for this service

        // Return the view for the main service with necessary data
        return view('frontend.services.service', compact('service', 'pageTitle', 'pageRoute'));
    }

    public function showSubService($parentSlug, $subSlug)
    {
        // Fetch the parent service
        $parentService = ServiceList::where('slug', $parentSlug)->firstOrFail();

        // Fetch the sub-service by slug and its parent ID
        $subService = ServiceList::where('slug', $subSlug)
            ->where('parent_id', $parentService->id)
            ->firstOrFail();

        // Paginate the projects related to the sub-service
        $projects = Project::where('subservice_id', $subService->id)->paginate(3); // You can adjust the number of items per page

        // Set the page title and route for the sub-service
        $pageTitle = ucwords(str_replace('-', ' ', $subService->slug));

        $pageRoute = route('subservice.show', [$parentSlug, $subSlug]); // Generate the route for the sub-service

        // Return the view for the sub-service with necessary data
        return view('frontend.services.subservice_project', compact('pageTitle', 'pageRoute', 'projects'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit($id)
    {
        $service = ServiceList::findOrFail($id);
        $subservices = $service->subservices; // Get sublist items if any
        return view('services.service_list.edit', compact('service', 'subservices'));


    }

    /**
     * Update the specified service in the database.
     */
    public function update(Request $request, $id)
    {
        // Find the main service by ID
        $service = ServiceList::findOrFail($id);
    
        // Initial validation rules
        $rules = [
            'service_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_lists,slug,' . $service->id,
            'url' => 'nullable|string|max:255|unique:service_lists,url,' . $service->id,
        ];
    
        // Validate sublist items if provided
        $subservices = $request->input('sublist_items');
    
        foreach ($subservices as $index => $subservice) {
            $subserviceId = $subservice['id'] ?? null; // Use null if 'id' is not set
    
            // Add validation rules for sublist items
            $rules['sublist_items.' . $index . '.name'] = 'nullable|string|max:255';
            $rules['sublist_items.' . $index . '.slug'] = 'nullable|string|max:255|unique:service_lists,slug,' . ($subserviceId ?? 'NULL');
            $rules['sublist_items.' . $index . '.url'] = 'nullable|string|max:255|unique:service_lists,url,' . ($subserviceId ?? 'NULL');
        }
    
        // Validate the request with the merged rules
        $request->validate($rules);
    
        // Update the main service
        $service->name = $request->service_name;
        $service->slug = $request->slug ?? Str::slug($request->service_name);
        $service->url = $request->url ?? route('service.show', $service->slug);
        $service->save();
    
        // Update or create sublist items
        if ($request->has('sublist_items')) {
            foreach ($request->sublist_items as $sublist) {
                // Ensure slug is set before generating the URL
                $slug = $sublist['slug'] ?? Str::slug($sublist['name']); // Generate slug if not provided
    
                // Create nested URL for sublist items
                $url = route('subservice.show', [$service->slug, $slug]); // Create nested URL
    
                // Use updateOrCreate with the correct parent_id
                ServiceList::updateOrCreate(
                    ['id' => $sublist['id'] ?? null], // Match by ID or null for new items
                    [
                        'name' => $sublist['name'],
                        'slug' => $slug,
                        'url' => $url, // Set the nested URL
                        'parent_id' => $service->id, // Ensure sublist items have the correct parent_id
                    ]
                );
            }
        }
    
        return redirect()->route('service-list.index')->with('success', 'Service updated successfully.');
    }
    

    /**
     * Remove the specified service from the database.
     */
    public function destroy($id)
    {
        $service = ServiceList::findOrFail($id);
        $service->delete(); // Delete the service and any subservices due to cascading
        return redirect()->route('service-list.index')->with('success', 'Service deleted successfully.');
    }
}
