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
    $user = Auth::user(); // pastikan ini benar-benar mengembalikan instance User

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save(); // seharusnya tidak error

    return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui.');
}

}
