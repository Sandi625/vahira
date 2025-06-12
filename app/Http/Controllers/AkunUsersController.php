<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunUsersController extends Controller
{
    // Tampilkan profil user
    public function index()
    {
        $user = Auth::user();
        return view('akunuser.profil', compact('user'));
    }

    // Tampilkan form edit profil
    public function editProfile()
    {
        $user = Auth::user();
        return view('akunuser.edituser', compact('user'));
    }

    // Proses update profil
public function updateProfile(Request $request)
{
    $user = Auth::user();

    if (!($user instanceof User)) {
        $user = User::find($user->id);
    }

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

    $user->save();

    return redirect()->route('akun.profile')->with('success', 'Profil berhasil diperbarui.');
}

}
