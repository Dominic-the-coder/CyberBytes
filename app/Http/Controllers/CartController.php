<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; 


class CartController extends Controller
{
    public function loadCartPage()
{
    // Fetch the current user's cart items
    $userId = Auth::id();
    $user = Auth::user();
    $userCart = Cart::where('user_id', $userId)->with('product')->get();

    return view('cart', compact('userCart', 'user'));
}




    public function addToCart(Request $request)
    {
        // Fetch all the products 
        $userId = Auth::id();
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);
        Cart::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('products.index');
    }

    public function removeFromCart($id){
$cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id == Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart.view')->with('success', 'Item removed from cart.');
            }
            public function editQuantity(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        // Find the cart item by ID
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        // Check if the cart item exists and belongs to the current user
        if ($cartItem) {
            // Update the quantity
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();

            // Redirect back with success message
            return redirect()->route('cart.view')->with('success', 'Quantity updated successfully');
        }

        // If not found, return error
        return redirect()->route('cart.view')->with('error', 'Item not found');
    }

    public function checkout(Request $request)
{
    // Assuming you have a method to clear the cart
    // This method should also handle payment processing, if applicable.
    // Clear the cart logic here
    $userId = Auth::id();
    Cart::where('user_id', $userId)->delete();
    // Get total amount from the request
    $total = $request->input('total');

    // Redirect to product index with a success message
    return redirect()->route('products.index')->with('lol', "Thanks for paying RM " . number_format($total, 2) . " to buy our products!");
}
}
