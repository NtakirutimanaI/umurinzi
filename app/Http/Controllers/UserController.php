<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display all users with pagination and available roles.
     */
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::all(); // Pass roles to view
        return view('admin.users', compact('users', 'roles'));
    }

    /**
     * Optional method to list users (reuse index).
     */
    public function users()
    {
        return $this->index();
    }

    /**
     * Toggle the user's active/inactive status.
     */
    public function toggleStatus(User $user)
    {
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    /**
     * Update user information.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phone' => 'required',
            'country_code' => 'nullable',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->country_code = $request->country_code;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Change the role of a user.
     */
    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'phone' => 'required|string|max:20',
            'country_code' => 'nullable|string|max:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',  // Ensure you have a password_confirmation input in your form
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->country_code = $request->country_code;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    }

        public function user()
    {
        $rows = request('rows', 10); // Default to 10 if not provided in the query
        $users = \App\Models\User::paginate($rows); // Use pagination instead of all()

        return view('admin.users', compact('users'));
    }
    

}
