<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(AuthRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            $user = User::create(['email' => $data['email']]);
        }

        Auth::guard('web-user')->login($user, true);

        return redirect('/');
    }

    public function logout()
    {
        Auth::guard('web-user')->logout();
        return redirect('/');
    }
}
