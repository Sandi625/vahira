<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\Customer;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik
        $paketCount = Paket::count();
        $pesananCount = Pesanan::count();
        $reservasiCount = Reservasi::count();
        $customerCount = Customer::count();

        $pesananBulanIni = \App\Models\Pesanan::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $reservasiBulanIni = \App\Models\Reservasi::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $customerBulanIni = \App\Models\Customer::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

        return view('dashboard', compact('paketCount', 'pesananCount', 'reservasiCount', 'customerCount', 'pesananBulanIni', 'reservasiBulanIni', 'customerBulanIni'));
    }
}
