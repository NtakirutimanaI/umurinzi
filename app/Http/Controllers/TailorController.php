<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TailorController extends Controller
{
    public function index()
    {
        return view('tailor.index'); 
    }
    public function dashboard()
{
    return view('tailor.index'); 
}
}
