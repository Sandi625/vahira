<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('admin')->latest()->get();
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        $admins = Admin::all();
        return view('customer.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_admin' => 'required|exists:admins,id_admin',
            'nama_customer' => 'required',
            'email_customer' => 'required|email|unique:customers,email_customer',
            'password' => 'required|min:6',
        ]);

        Customer::create([
            'id_admin' => $request->id_admin,
            'nama_customer' => $request->nama_customer,
            'email_customer' => $request->email_customer,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan');
    }

    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $admins = Admin::all();
        return view('customer.edit', compact('customer', 'admins'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'id_admin' => 'required|exists:admins,id_admin',
            'nama_customer' => 'required',
            'email_customer' => 'required|email|unique:customers,email_customer,' . $customer->id_customer . ',id_customer',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'id_admin' => $request->id_admin,
            'nama_customer' => $request->nama_customer,
            'email_customer' => $request->email_customer,
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $customer->update($data);

        return redirect()->route('customer.index')->with('success', 'Customer berhasil diupdate');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus');
    }
}
