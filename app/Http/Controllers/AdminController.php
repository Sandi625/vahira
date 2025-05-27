<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

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
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        Admin::create($request->all());

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'nama_admin' => 'required|max:100',
            'email' => 'required|email|unique:admins,email,' . $admin->id_admin . ',id_admin',
            'password' => 'nullable|min:6',
        ]);

        $data = $request->only('nama_admin', 'email');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
