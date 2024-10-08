<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function loadContactPage()
    {
        $user = Auth::user();
        return view('contact', compact('user'));
    }
}
