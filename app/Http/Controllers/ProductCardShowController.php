<?php

namespace App\Http\Controllers;

use App\Models\ProductCardShow;
use Illuminate\Http\Request;

class ProductCardShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCards = ProductCardShow::paginate(5); // 10 items per page
        return view('home.product_card.index', compact('productCards'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.product_card.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'product_card_title' => 'required|string|max:25',
            'product_card_image' => 'required|image|max:20480',
            'product_card_description' => 'required|string|max:350',
        ]);

        // Handle the image upload for the product_card_image field
        if ($request->hasFile('product_card_image')) {
            $product_card_image = $request->file('product_card_image');
            
            // Generate a unique filename for the logo
            $filename = time() . '.' . $product_card_image->getClientOriginalExtension();
            
            // Define the path where the logo will be stored (in the public/product_cards directory)
            $path = public_path('product_cards');
    
            // Create the directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            // Move the uploaded file to the public/product_cards directory
            $product_card_image->move($path, $filename);
    
            // Save the file path and other form data in the database
            ProductCardShow::create([
                'product_card_title' => $request->input('product_card_title'),
                'product_card_image' => 'product_cards/' . $filename,  
                'product_card_description' => $request->input('product_card_description'),
            ]);
    
        } else {
            // Handle the case where no logo is uploaded
            return back()->withErrors(['product_card_image' => 'Product Card image is required.']);
        }
        

        // Redirect back with a success message
        return redirect()->route('product_card.index')->with('success', 'Product Card created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productCards = ProductCardShow::find($id);
        return view('home.product_card.edit', compact('productCards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productCard = ProductCardShow::findOrFail($id);

        // Validate the form inputs
        $request->validate([
            'product_card_title' => 'required|string|max:25',
            'product_card_image' => 'nullable|image|max:20480',
            'product_card_description' => 'required|string|max:350',
        ]);

        // Update the Product Card's basic fields
        $productCard->product_card_title = $request->input('product_card_title');
        $productCard->product_card_description = $request->input('product_card_description');

        if ($request->hasFile('product_card_image')) {
            // Get the old logo path
            $oldauthorpath = public_path($productCard->product_card_image);

            // Check if the old logo exists and delete it
            if ($productCard->product_card_image && file_exists($oldauthorpath)) {
                unlink($oldauthorpath); // Delete the old logo image
            }

            // Store the new logo in the 'product_cards' directory within the public folder
            $logo = $request->file('product_card_image');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('product_cards'), $filename);

            // Update the logo path in the database
            $productCard->product_card_image = 'product_cards/' . $filename;
        }

        // Save the updated Product Card data
        $productCard->save();

        // Redirect back to the Product Card list with a success message
        return redirect()->route('product_card.index')->with('success', 'Product Card updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCard = ProductCardShow::find($id);
        if ($productCard) {
            $productCard->delete();
            return redirect()->route('product_card.index')->with('success', 'Product Card deleted successfully.');
        }
        return redirect()->route('product_card.index')->with('failure', 'Product Card not found.');
    }
}
