<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityLogger;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            ActivityLogger::log(
                'Login',
                'Authentication',
                'User ' . $user->name . ' berhasil login ke sistem.'
            );

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.backoffice.dashboard');
            }

            if ($user->hasRole('pasien')) {
                return redirect()->route('pasien.dashboard');
            }

            if ($user->hasRole('tenaga_medis') || $user->hasRole('dokter')) {
                return redirect()->route('tenaga-medis.dashboard');
            }

            if ($user->hasRole('pimpinan')) {
                return redirect()->route('pimpinan.dashboard');
            }

            Auth::logout();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Role user belum terdaftar.',
                ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Email atau password salah.',
            ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            ActivityLogger::log(
                'Logout',
                'Authentication',
                'User ' . $user->name . ' keluar dari sistem.'
            );
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}