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
            ->get();

        $transactionToday = Transaksi::query()
            ->whereDate('created_at', date('Y-m-d'))
            ->get();

        $summary = [
            'total_produk' => $produk->count(),
            'jumlah_transaksi' => $transactionToday->count(),
            'total_transaksi' => $transactionToday->sum('total_harga'),

        ];

        $produk = $produk->take(5);

        return view('admin.dashboard', compact('transaksi', 'produk', 'summary'));
    }
}
