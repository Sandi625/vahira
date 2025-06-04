<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
   public function index()
{
    $pakets = Paket::where('status', true)->latest()->get(); // Misalnya hanya paket yang aktif

    return view('landing', compact('pakets')); // Kirim data ke view
}
}
