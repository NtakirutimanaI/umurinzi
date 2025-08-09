<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class BusinessPersonController extends Controller
{
    public function index()
    {
        return view('business.index'); 
    }
}
