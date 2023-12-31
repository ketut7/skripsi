<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::query()
            ->with('user')
            ->paginate(10);

        return view('admin.transaksi', compact('transaksi'));
    }

    public function show(Transaksi $transaksi)
    {
        return view('admin.transaksi-detail', compact('transaksi'));
    }

    public function update(Transaksi $transaksi, Request $request)
    {
        if ($request->input('status', null))
            $transaksi->status = $request->status;

        if ($request->input('status_pengiriman', null))
            $transaksi->status_pengiriman = $request->status_pengiriman;

        $transaksi->no_resi = $request->input('no_resi', null);
        $transaksi->save();

        return redirect()->back()->with('success', 'Status transaksi berhasil diubah');
    }
}
