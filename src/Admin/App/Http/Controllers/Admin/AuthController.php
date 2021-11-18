<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth;
use App\Services\Admin\Auth\Authentication;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Auth $request)
    {
        $phone = $request->get('phone');
        $password = $request->get('password');

        try {
            (new Authentication())->auth($phone, $password);
        } catch (\Throwable $e) {
            return view('login')->withErrors([$e->getMessage()]);
        }

        return redirect()->route('admin.home');
    }

    public function logout(Request $request)
    {
        (new Authentication())->logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login-form');
    }
}
