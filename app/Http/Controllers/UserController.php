<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mat_register(Request $request)
    {
        $mat_Request = $request->validate([
            'mat_name' => ['required', Rule::unique('tbl_materials', 'mat_name')],
            'mat_desc' => 'required',
            'mat_brand' => 'required',
            'mat_unit' => 'required'
        ]);
        $log_user = User::create($mat_Request);
        auth()->login($log_user);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $user_info = $request->validate([
            'loginemail' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['email' => $user_info['loginemail'], 'password' => $user_info['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
}
