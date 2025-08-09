<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    // Show client form or list view
    public function index()
    {
        return view('client.index');
    }

    // Handle form submission and save client data, then return JSON response
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'address'      => 'nullable|string|max:255',
            'city'         => 'nullable|string|max:255',
            'country'      => 'nullable|string|max:255',
            'national_id'  => 'nullable|string|max:255',
            'gender'       => 'nullable|in:Male,Female,Other',
            'date_of_birth'=> 'nullable|date',
            'notes'        => 'nullable|string',
        ]);

        $client = Client::create($request->only([
            'name', 'phone', 'email', 'address', 'city', 'country', 'national_id', 'gender', 'date_of_birth', 'notes'
        ]));

        return response()->json(['success' => true, 'client_id' => $client->id]);
    }
}
