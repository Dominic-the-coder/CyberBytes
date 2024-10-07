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

        //Fetch products with type 'sale'
        $saleProducts = Product::where('type', 'sale')->get();

        // Pass both collections to the Blade view
        return view('products', compact('popularProducts', 'latestProducts', 'user'));
    }

    public function updateProduct(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'product_id' => 'required|exists:products,id'
    ]);

    $product = Product::findOrFail($request->product_id);
    $product->name = $request->name;
    $product->price = $request->price;
    $product->save(); 

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

public function DeleteProduct($id){
    $product = Product::findOrFail($id);
    
            if (Auth::user()->role_id == 1) {
                $product->delete();
            }
    
            return redirect()->route('products.index')->with('success', 'Item removed from cart.');
                }


}