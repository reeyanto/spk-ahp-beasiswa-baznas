<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Models\User;

class UserController extends Controller
{

    public function index() {
        return view('login.index');
    }
    
    public function login(UserLoginRequest $request) {
        if(auth()->attempt($request->validated())) {
            return redirect()->route('dashboard.index')->with('success', 'Selamat datang, ' . auth()->user()->nama);
        }
        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('/')->with('success', 'Anda telah berhasil logout');
    }

    public function password() {
        return view('admin.password.index');
    }

    public function password_update(UserUpdatePasswordRequest $request) {
        $update = auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);

        if($update) {
            auth()->logout();
            return redirect()->route('/')->with('success', 'Password berhasil diperbarui. Silakan masuk kembali menggunakan password baru.');
        }
        return redirect()->back()->withErrors('Password gagal diperbarui');
    }
}
