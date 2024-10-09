<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create the review
        Review::create([
            'content' => $request->content,
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
        ]);

        // Redirect back to the same page
        return redirect()->route('products.index')->with('success', 'Review added successfully.');
    }
    public function deleteReview($id)
{
    $review = Review::findOrFail($id);
    
    $review->delete();

    return redirect()->route('products.index')->with('success', 'Review removed successfully.');
}

}
