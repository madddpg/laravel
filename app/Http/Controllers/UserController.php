<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // READ (All users)
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // CREATE (Show form)
    public function create()
    {
        return view('users.create');
    }

    // CREATE (Save user)
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|unique:tbl_signup,username',
            'email' => 'required|email|unique:tbl_signup,email',
            'password' => 'required|min:8'
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect('/users');
    }

    // READ (Single user)
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // UPDATE (Show edit form)
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // UPDATE (Save changes)
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'username' => 'required|unique:tbl_signup,username,' . $user->id,
            'email' => 'required|email|unique:tbl_signup,email,' . $user->id,
        ]);

        $user->update($data);

        return redirect('/')->with('success', 'User updated successfully.');
    }

    // DELETE
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/')->with('success', 'User deleted successfully.');
    }

    // AUTH (extra, not CRUD)
    public function showLogin()
    {
        return view('auth.login');
    }

    public function loginCustomer(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255'
        ]);

        $request->session()->put('customer_username', $data['username']);
        $request->session()->regenerate();
        
        return redirect('/menu')->with('success', 'Welcome, ' . $data['username'] . '!');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        // Attempt login for the first admin (or modify if multiple admins exist)
        $admin = \App\Models\Admin::first();

        if ($admin && auth()->guard('admin')->attempt([
            'email' => $admin->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Logged in as Admin successfully.');
        }

        return back()->withErrors(['password' => 'Invalid admin password'])->withInput();
    }

    public function logout(Request $request)
    {
        if (auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout();
        }

        auth()->logout();
        $request->session()->forget('customer_username');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}