<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
    public function users()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $users = User::all();
        return view('admin.users', compact('users'));
    }
}
