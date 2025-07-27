<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
{
    $user = Auth::user();
    return view('akun.pengaturan', compact('user'));
}

public function edit()
{
    $user = Auth::user();
    return view('akun.edit', compact('user'));
}

public function update(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'no_hp' => 'nullable|string|max:20', // tambahkan validasi untuk no_hp
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->no_hp = $request->no_hp; // tambahkan ini

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui.');
}


}
