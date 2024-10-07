<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditController extends Controller
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ]);

    // Find the product by ID and update its details
    $product = Product::findOrFail($id);
    $product->name = $request->name;
    $product->price = $request->price;
    $product->save(); // Save the updated product

    // Redirect back with a success message
    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}
