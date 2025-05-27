<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;  // Add this line to import the Hash facade
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    // Show Register Form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle Registration Logic
   public function register(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Simpan pengguna baru
    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    // Kembali ke form dengan pesan sukses (SweetAlert)
    return back()->with('success', 'Pendaftaran berhasil! Data telah disimpan.');
}



    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }


public function login(Request $request)
{
    // Validate the data
    $validated = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ]);

    // Attempt to log the user in
    if (Auth::attempt($validated)) {
        // Check if the authenticated user is an admin
        if (Auth::user()->role === \App\Enums\Role::Admin) {
            return redirect()->route('dashboard.index'); // Redirect to the admin dashboard
        } else {
            return redirect()->route('dashboardpelanggan'); // Redirect to the customer dashboard
        }
    }

    // If authentication fails
    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
}


    // Handle Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
