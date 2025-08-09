<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CraftsPersonController extends Controller
{
    public function index()
    {
        return view('craftsperson.index');  
    }

    public function dashboard()
    {
        return view('craftsperson.index');
    }
}
