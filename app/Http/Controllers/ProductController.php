<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch products with type 'popular'
        $popularProducts = Product::where('type', 'popular')->get();

        // Fetch products with type 'latest'
        $latestProducts = Product::where('type', 'latest')->get();

        // Pass both collections to the Blade view
        return view('products', compact('popularProducts', 'latestProducts'));
    }
}