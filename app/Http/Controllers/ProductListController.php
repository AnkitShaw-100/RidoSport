<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductList;
// use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductListController extends Controller
{
    /**
     * Display a list of all products and their sublists.
     */
    public function index()
    {
        $products = ProductList::whereNull('parent_id')->with('subproducts')->get();
        return view('products.product_list.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('products.product_list.create');
    }

    /**
     * Store a newly created product or sublist in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_lists,slug',
            'url' => 'nullable|string|max:255|unique:product_lists,url',
            'sublist_items.*.name' => 'nullable|string|max:255',
            'sublist_items.*.slug' => 'nullable|string|max:255|unique:product_lists,slug',
            'sublist_items.*.url' => 'nullable|string|max:255|unique:product_lists,url',
        ]);
    
        // Create the main product
        $mainProduct = ProductList::create([
            'name' => $request->product_name,
            'slug' => $request->slug ?? Str::slug($request->product_name),
            'url' => $request->url ?? route('product.show', Str::slug($request->product_name)),
            'parent_id' => null, // Main product has no parent
        ]);
    
        // Save sublist items if provided
        if ($request->has('sublist_items')) {
            foreach ($request->sublist_items as $sublist) {
                // Ensure name exists before creating sublist
                if (!empty($sublist['name'])) {
                    ProductList::create([
                        'name' => $sublist['name'],
                        'slug' => $sublist['slug'] ?? Str::slug($sublist['name']),
                        'url' => $sublist['url'] ?? route('product.show', $mainProduct->slug . '/' . Str::slug($sublist['name'])),
                        'parent_id' => $mainProduct->id, // Set the parent to the main product
                    ]);
                }
            }
        }
    
        // Redirect back to the product list with a success message
        return redirect()->route('product-list.index')->with('success', 'Product and sublist created successfully.');
    }
    

    public function show($slug)
    {
        // Fetch the main product by slug
        $product = ProductList::where('slug', $slug)->firstOrFail();
    
        $productDetails = Product::where('subproduct_id', $product->id)->first(); 
    
        // Set the page title and route
        $pageTitle = $product->name;
        $pageRoute = route('product.show', $slug);

        // Decode technical_details JSON string into an associative array
        if (isset($productDetails->technical_details) && is_string($productDetails->technical_details)) {
            $productDetails->technical_details = json_decode($productDetails->technical_details, true);
        }

        // Decode advantages JSON string into an array
        if (isset($productDetails->advantages) && is_string($productDetails->advantages)) {
            $productDetails->advantages = json_decode($productDetails->advantages, true);
        }

        // Decode colors JSON string into an array
        if (isset($productDetails->colors) && is_string($productDetails->colors)) {
            $productDetails->colors = json_decode($productDetails->colors, true);
        }

        // Decode why_choose JSON string into an associative array
        if (isset($productDetails->why_choose) && is_string($productDetails->why_choose)) {
            $productDetails->why_choose = json_decode($productDetails->why_choose, true);
        }
    
        // Return the view for the main product with necessary data
        return view('frontend.products.show', compact('product', 'productDetails', 'pageTitle', 'pageRoute'));
    }
    

    public function showSubProduct($Slug, $subSlug)
    {
        // Fetch the parent product by slug
        $Parentproduct = ProductList::where('slug', $Slug)->firstOrFail();
    
        // Fetch the sub-product by its slug and parent product's ID
        $product = ProductList::where('slug', $subSlug)
            ->where('parent_id', $Parentproduct->id)
            ->firstOrFail();
            
    
        // Fetch sub-product specific details
        $productDetails = Product::where('subproduct_id', $product->id)->first();
    
        // Set the page title and route
        $pageTitle = $product->name;
        $pageRoute = route('subproduct.show', [$Slug, $subSlug]);

        // Decode technical_details JSON string into an associative array
        if (isset($productDetails->technical_details) && is_string($productDetails->technical_details)) {
            $productDetails->technical_details = json_decode($productDetails->technical_details, true);
        }

        // Decode advantages JSON string into an array
        if (isset($productDetails->advantages) && is_string($productDetails->advantages)) {
            $productDetails->advantages = json_decode($productDetails->advantages, true);
        }

        // Decode colors JSON string into an array
        if (isset($productDetails->colors) && is_string($productDetails->colors)) {
            $productDetails->colors = json_decode($productDetails->colors, true);
        }

        // Decode why_choose JSON string into an associative array
        if (isset($productDetails->why_choose) && is_string($productDetails->why_choose)) {
            $productDetails->why_choose = json_decode($productDetails->why_choose, true);
        }
    

    
        // Return the view for the sub-product with the same data structure as the main product
        return view('frontend.products.show', compact('product', 'productDetails', 'pageTitle', 'pageRoute'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = ProductList::findOrFail($id);
        $subproducts = $product->subproducts; // Get sublist items if any
        return view('products.product_list.edit', compact('product', 'subproducts'));
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, $id)
    {
        // Find the main product by ID
        $product = ProductList::findOrFail($id);
    
        // Initial validation rules for main product
        $rules = [
            'product_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_lists,slug,' . $product->id,
            'url' => 'nullable|string|max:255|unique:product_lists,url,' . $product->id,
        ];
    
        // Validate sublist items if provided
        $subproducts = $request->input('sublist_items', []);
        foreach ($subproducts as $index => $subproduct) {
            $subproductId = $subproduct['id'] ?? null; // Use null if 'id' is not set
    
            // Add validation rules for sublist items
            $rules['sublist_items.' . $index . '.name'] = 'nullable|string|max:255';
            $rules['sublist_items.' . $index . '.slug'] = 'nullable|string|max:255|unique:product_lists,slug,' . ($subproductId ?? 'NULL');
            $rules['sublist_items.' . $index . '.url'] = 'nullable|string|max:255|unique:product_lists,url,' . ($subproductId ?? 'NULL');
        }
    
        // Validate the request with the merged rules
        $request->validate($rules);
    
        // Update the main product
        $product->name = $request->product_name;
        $product->slug = $request->slug ?? Str::slug($request->product_name);
        $product->url = $request->url ?? route('product.show', $product->slug);
        $product->save();
    
        // Handle sublist items (create/update)
        $existingSublistIds = $product->subproducts()->pluck('id')->toArray(); // Get existing sublist IDs for deletion check
        $submittedSublistIds = [];
    
        if ($request->has('sublist_items')) {
            foreach ($request->sublist_items as $sublist) {
                // Track submitted sublist items to prevent deletion
                if (isset($sublist['id'])) {
                    $submittedSublistIds[] = $sublist['id'];
                }
    
                $slug = $sublist['slug'] ?? Str::slug($sublist['name']); // Generate slug if not provided
                $url = $sublist['url'] ?? route('product.show', [$product->slug.'/'. $slug]); // Create nested URL
    
                // Use updateOrCreate with the correct parent_id
                ProductList::updateOrCreate(
                    ['id' => $sublist['id'] ?? null], // Match by ID or create a new one
                    [
                        'name' => $sublist['name'],
                        'slug' => $slug,
                        'url' => $url,
                        'parent_id' => $product->id, // Ensure sublist items have the correct parent_id
                    ]
                );
            }
        }
    
        // Delete sublist items that were removed
        $itemsToDelete = array_diff($existingSublistIds, $submittedSublistIds);
        ProductList::destroy($itemsToDelete);
    
        return redirect()->route('product-list.index')->with('success', 'Product updated successfully.');
    }
    
    

    /**
     * Remove the specified product from the database.
     */
    public function destroy($id)
    {
        $product = ProductList::findOrFail($id);
        $product->delete(); // Delete the product and any subproducts due to cascading
        return redirect()->route('product-list.index')->with('success', 'Product deleted successfully.');
    }
}
