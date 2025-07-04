<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }
    public function show(Admin $admin)
{
    return view('admin.show', compact('admin'));
}


public function store(Request $request)
{
    $request->validate([
        'nama_admin' => 'required|max:100',
        'email' => 'required|email|unique:admins,email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    // 1. Simpan user terlebih dahulu
    $user = User::create([
        'name' => $request->nama_admin,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => Role::Admin,
    ]);

    // 2. Simpan admin dengan menghubungkan ke user melalui user_id
    Admin::create([
        'user_id' => $user->id,
        'nama_admin' => $request->nama_admin,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
}


    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

public function update(Request $request, Admin $admin)
{
    $user = $admin->user; // langsung ambil dari relasi user_id

    // Log user
    Log::info('[Admin Update] User ditemukan melalui relasi:', ['user' => $user]);

    $request->validate([
        'nama_admin' => 'required|max:100',
        'email' => [
            'required',
            'email',
            Rule::unique('admins', 'email')->ignore($admin->id_admin, 'id_admin'),
            Rule::unique('users', 'email')->ignore($user?->id),
        ],
        'password' => 'nullable|min:6',
    ]);

    // Update Admin
    $admin->nama_admin = $request->nama_admin;
    $admin->email = $request->email;
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->password);
    }
    $admin->save();
    Log::info('[Admin Update] Admin updated:', ['admin' => $admin]);

    // Update User
    if ($user) {
        $user->name = $request->nama_admin;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        Log::info('[Admin Update] User updated:', ['user' => $user]);
    } else {
        Log::warning('[Admin Update] Tidak ada user terkait dengan admin (user_id null?)');
    }

    return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
}



  public function destroy(Admin $admin)
{
    $user = $admin->user;

    if ($user) {
        $user->delete();
    }

    $admin->delete();

    return redirect()->route('admin.index')->with('success', 'Admin dan user terkait berhasil dihapus.');
}

}
