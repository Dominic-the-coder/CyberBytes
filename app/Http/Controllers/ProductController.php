<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch products with type 'popular'
        $popularProducts = Product::where('type', 'popular')->get();

        // Fetch products with type 'latest'
        $latestProducts = Product::where('type', 'latest')->get();

        // Fetch products with type 'sale'
        $saleProducts = Product::where('type', 'sale')->get();

        // Pass both collections to the Blade view
        return view('products', compact('popularProducts', 'latestProducts', 'saleProducts', 'user'));
    }

    public function updateProduct(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        'price' => 'required|numeric|min:0',
        'product_id' => 'required|exists:products,id',
        'type' => 'required|string|in:popular,latest,sale', // Validate product type
    ]);

    // Find the product by ID
    $product = Product::findOrFail($request->product_id);

    // Update product attributes
    $product->name = $request->name;
    $product->price = $request->price;
    $product->type = $request->type; // Update product type

    // Handle the image upload
    if ($request->hasFile('image')) {
        // Store the image in the public/images directory
        $imagePath = $request->file('image')->store('images', 'public');

        // Save the image path in the database
        $product->image = '/storage/' . $imagePath; // Save the URL path to the product
    }

    // Save the updated product
    $product->save();

    // Redirect back with success message
    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        if (Auth::user()->role_id == 1) {
            $product->delete();
        }
    
        return redirect()->route('products.index')->with('success', 'Item removed from cart.');
    }

    public function addProduct(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
            'price' => 'required|numeric|min:1',
            'type' => 'required|string|in:popular,latest,sale',
        ]);

        // Handle image upload
        $imagePath = null; // Initialize image path variable
        if ($request->hasFile('image')) {
            // Get the file from the request
            $image = $request->file('image');
            
            // Generate a unique file name with extension
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Move the file to the public/images directory
            $image->move(public_path('images'), $imageName);
            
            // Store the image path in the database
            $imagePath = '/images/' . $imageName;
        }

        // Create a new product and save it to the database
        Product::create([
            'name' => $request->name,
            'image' => $imagePath,  // Save image path
            'price' => $request->price,
            'type' => $request->type,
        ]);

        // Redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }
}
