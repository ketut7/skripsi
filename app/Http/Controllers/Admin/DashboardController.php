<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::query()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->take(5);

        $produk = Produk::query()
            ->orderBy('created_at', 'desc')
            ->get()
            ->take(5);

        return view('admin.dashboard', compact('transaksi', 'produk'));
    }
}
