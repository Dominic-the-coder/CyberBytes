<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function loadCartPage() 
    {
        return view("cart");
    }
}
