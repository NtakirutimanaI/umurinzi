<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediatorController extends Controller
{
    public function index()
    {
        return view('mediator.index'); 
    }
    public function dashboard()
    {
        return view('mediator.index'); 
}
}