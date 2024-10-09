<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Allow these fields for mass assignment
    protected $fillable = ['content', 'product_id', 'user_id'];

    // Each review belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Each review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
