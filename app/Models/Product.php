<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'image',
        'price',
        'type',
    ];

    // Define the relationship with reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

