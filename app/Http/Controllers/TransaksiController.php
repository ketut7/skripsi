<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function tambahKeranjang(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah'    => 'required|integer|min:1',
        ]);

        Keranjang::updateOrCreate(
            [
                'user_id'   => auth()->id(),
                'produk_id' => $request->produk_id,
            ],
            [
                'jumlah' => $request->jumlah,
            ]
        );

        if ($request->submit == 'tambah-keranjang') {
            return redirect()->back()->with('success', 'Berhasil menambahkan produk ke keranjang');
        } else {
            return redirect()->route('keranjang.index')->with('success', 'Berhasil menambahkan produk ke keranjang');
        }
    }

    public function keranjang()
    {
        $keranjang = Keranjang::query()
            ->where('user_id', auth()->id())
            ->with('produk')
            ->get()
            ->map(function ($item) {
                $item->nama_produk  = $item->produk->nama;
                $item->harga        = $item->produk->harga;
                $item->total_harga  = $item->jumlah * $item->produk->harga;

                return $item;
            });

        $totalHarga = $keranjang->sum('total_harga');
        return view('keranjang', compact('keranjang', 'totalHarga'));
    }

    public function hapusItemKerajang(Request $request, Keranjang $keranjang)
    {
        $keranjang->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus produk dari keranjang');
    }

    public function checkout()
    {
        $user = auth()->user();
        $keranjang = $user
            ->keranjang
            ->load('produk')
            ->map(function ($item) {
                $item->nama     = $item->produk->nama;
                $item->berat    = $item->produk->berat;
                $item->harga    = $item->produk->harga;
                $item->total    = $item->jumlah * $item->produk->harga;

                return $item;
            });

        if ($keranjang->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang masih kosong');
        }


        DB::beginTransaction();
        try {
            $ongkir = 10000;
            $transaksi = Transaksi::create([
                'no_transaksi'  => date('YmdHis'),
                'user_id'       => $user->id,
                'alamat'        => $user->alamat,
                'nomor_telepon' => $user->nomor_telepon,
                'total_item'    => $keranjang->sum('total'),
                'ongkir'        => $ongkir,
                'total_harga'         => $keranjang->sum('total') + $ongkir,
            ]);

            $test = $transaksi->detail()->createMany($keranjang->toArray());
            $user->keranjang()->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->back()->with('error', 'Gagal checkout');
        }

        return redirect()->route('transaksi.show', $transaksi)->with('success', 'Berhasil checkout, silahkan lakukan pembayaran');
    }

    public function index()
    {
        $transaksi = Transaksi::query()
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transaksi', compact('transaksi'));
    }

    public function show(Transaksi $transaksi)
    {
        return view('transaksi-detail', compact('transaksi'));
    }

    public function konfirmasiPembayaran(Request $request, Transaksi $transaksi)
    {
        $file           = $request->file('bukti_pembayaran');
        $tujuan_upload  = 'bukti_pembayaran';
        $namaFile       = 'transaksi_' . $transaksi->no_transaksi . '.' . $file->getClientOriginalExtension();

        // upload file
        $file->move($tujuan_upload, $namaFile);

        DB::beginTransaction();
        try {
            $transaksi->update([
                'bukti_pembayaran'  => $namaFile,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status'            => 'menunggu verifikasi',
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi pembayaran');
        }


        return redirect()->back()->with('success', 'Berhasil mengkonfirmasi pembayaran');
    }
}
