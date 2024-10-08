<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{

    public function loadAboutPage()
    {
        $user = Auth::user();
        return view('about', compact('user'));
    }
}
