<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PatientRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register-pasien');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        if (Role::where('name', 'pasien')->exists()) {
            $user->assignRole('pasien');
        }

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil. Silakan login menggunakan akun pasien.');
    }
}