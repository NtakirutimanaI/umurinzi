<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityReportController extends Controller
{
    public function index()
    {
        // You can load data here and pass to the view
        return view('technician.register_view_data'); 
    }
}
