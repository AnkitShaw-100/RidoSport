<?php

namespace App\Http\Controllers;


use App\Models\ProductList; 
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    public function index()
    {
        // Fetch paginated products with their related subproduct
        $products = Product::with('subproduct')->paginate(5); // 10 products per page

        return view('products.product_data.index', compact('products'));
    }
    public function create()
    {
        // Fetch subproducts to display in a select dropdown
        $subproducts = ProductList::whereNotNull('id')->get();

        return view('products.product_data.create', compact('subproducts'));
    
    }
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'subproduct_id' => 'required|exists:product_lists,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'technical_details.thickness' => 'required|string|max:255',
            'technical_details.material' => 'required|string|max:255',
            'technical_details.surface_type' => 'required|string|max:255',
            'advantages' => 'required|array|min:1',
            'colors' => 'required|array|min:1',
            'colors.*.key' => 'required|string',
            'colors.*.value' => 'required|string',
            'why_choose' => 'required|array|min:1',
            'why_choose.*.key' => 'required|string',
            'why_choose.*.value' => 'required|string',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        try {
            // Create a new product record
            $product = new Product();
    
            // Set basic fields
            $product->subproduct_id = $validated['subproduct_id'];
            $product->name = $validated['name'];
            $product->description = $validated['description'];
    
            $product->technical_details = $validated['technical_details'];
    
            // Set advantages (simple array)
            $product->advantages = $validated['advantages']; // Encode as JSON
    
            $product->colors = $validated['colors'];

            // Set reasons for "Why Choose Us" (array of key-value pairs)
            $product->why_choose = $validated['why_choose'];
    
            // Handle the main product image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = public_path('products/images');
    
                // Create the directory if it doesn't exist
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
    
                $image->move($path, $filename);
                $product->image = 'products/images/' . $filename;
            }
    
            // Handle gallery images upload
            $galleryImages = [];
            if ($request->hasFile('gallery_images')) {
                $galleryImagesArray = $request->file('gallery_images');
                $galleryPath = public_path('products/gallery');
    
                // Create the directory if it doesn't exist
                if (!file_exists($galleryPath)) {
                    mkdir($galleryPath, 0777, true);
                }
    
                foreach ($galleryImagesArray as $galleryImage) {
                    $galleryFilename = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                    $galleryImage->move($galleryPath, $galleryFilename);
                    $galleryImages[] = 'products/gallery/' . $galleryFilename;
                }
            }
    
            // Set gallery images
            $product->gallery_images = json_encode($galleryImages); // Encode as JSON
    
            // Save the new product to the database
            $product->save();
    
            // Redirect with a success message
            return redirect()->route('product-data.index')->with('success', 'Product created successfully.');
    
        } catch (\Exception $e) {
            // Log the error and return back with an error message
            Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the product. Please try again.');
        }
    }
    
    
    
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $subproducts = ProductList::whereNotNull('id')->get();

        // Decode technical_details JSON string into an associative array
        if (is_string($product->technical_details)) {
            $product->technical_details = json_decode($product->technical_details, true);
        }

            // // Decode advantages JSON string into an array
            // if (is_string($product->advantages)) {
            //     $product->advantages = json_decode($product->advantages, true);
            // }




        return view('products.product_data.edit', compact('product','subproducts'));
    
    }




    public function update(Request $request, $id)
    {
        // Validate the input data
        $validated = $request->validate([
            'subproduct_id' => 'required|exists:product_lists,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'technical_details.thickness' => 'required|string|max:255',
            'technical_details.material' => 'required|string|max:255',
            'technical_details.surface_type' => 'required|string|max:255',
            'advantages' => 'required|array|min:1',
            'colors' => 'required|array|min:1',
            'colors.*.key' => 'required|string',
            'colors.*.value' => 'required|string',
            'why_choose' => 'required|array|min:1',
            'why_choose.*.key' => 'required|string',
            'why_choose.*.value' => 'required|string',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'delete_images' => 'nullable|array',
        ]);
    
        // Find the product by ID
        $product = Product::findOrFail($id);
    
        // Update basic fields
        $product->subproduct_id = $validated['subproduct_id'];
        $product->name = $validated['name'];
        $product->description = $validated['description'];
    
 
        // Update technical details
        $product->technical_details = $validated['technical_details'];
    
        // Update advantages (simple array)
        $product->advantages = $validated['advantages'];
    
        // Update colors (array of key-value pairs)
        $product->colors = $validated['colors'];
    
        // Update reasons for "Why Choose Us" (array of key-value pairs)
        $product->why_choose = $validated['why_choose'];
    
        // Handle the main product image upload
        $imagePath = $product->image; // Default to existing image
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // Store new image
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('products/images');

            // Create the directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $filename);
            $imagePath = 'products/images/' . $filename;
        }

        // Update image path
        $product->image = $imagePath;

        // Handle the gallery images upload
        $galleryImages = json_decode($product->gallery_images, true) ?? [];
        if ($request->hasFile('gallery_images')) {
            $galleryImagesArray = $request->file('gallery_images');
            $galleryPath = public_path('products/gallery');

            // Create the directory if it doesn't exist
            if (!file_exists($galleryPath)) {
                mkdir($galleryPath, 0777, true);
            }

            foreach ($galleryImagesArray as $galleryImage) {
                $galleryFilename = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move($galleryPath, $galleryFilename);
                $galleryImages[] = 'products/gallery/' . $galleryFilename;
            }
        }

        // Handle deletion of gallery images
        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $deleteImage) {
                if (($key = array_search($deleteImage, $galleryImages)) !== false) {
                    // Delete the image from storage
                    if (file_exists(public_path($deleteImage))) {
                        unlink(public_path($deleteImage));
                    }
                    // Remove from array
                    unset($galleryImages[$key]);
                }
            }
        }

        // Update gallery images field
        $product->gallery_images = json_encode(array_values($galleryImages));

    
        // Save the updated product to the database
        $product->save();
    
        // Redirect with a success message
        return redirect()->route('product-data.index')->with('success', 'Product updated successfully.');
    }
    
    

    public function destroy($id)
    {
        // Find the product or fail
        $product = Product::findOrFail($id);
    
        // Decode gallery images to an array
        $galleryImages = json_decode($product->gallery_images, true) ?? [];
    
        // Delete gallery images from storage
        foreach ($galleryImages as $galleryImage) {
            if (file_exists(public_path($galleryImage))) {
                unlink(public_path($galleryImage));
            }
        }
    
        // Optionally delete the main product image
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
    
        // Delete the product
        $product->delete();
    
        // Optionally, redirect or return a response
        return redirect()->back()->with('success', 'Product and associated images deleted successfully.');
    }
    
    
}


