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
    $userCart = Cart::where('user_id', $userId)->with('product')->get();

    return view('cart', compact('userCart'));
}


    public function addToCart(Request $request)
    {
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
}
