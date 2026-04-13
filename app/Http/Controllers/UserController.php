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

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|unique:tbl_signup,username',
            'email' => 'required|email|unique:tbl_signup,email',
            'password' => 'required|min:8'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        auth()->login($user);

        return redirect('/menu')->with('success', 'Registration successful! You are now logged in.');
    }

    public function login(Request $request)
    {
        $user_info = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->guard('admin')->attempt([
            'email' => $user_info['email'],
            'password' => $user_info['password']
        ])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Logged in as Admin successfully.');
        }

        if (auth()->attempt([
            'email' => $user_info['email'],
            'password' => $user_info['password']
        ])) {
            $request->session()->regenerate();
            return redirect('/menu')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        if (auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}