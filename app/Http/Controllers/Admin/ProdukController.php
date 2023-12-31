<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::paginate(10);

        return view('admin.produk', compact('produk'));
    }

    public function create()
    {
        return view('admin.produk-form', ['produk' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
        ], [
            'nama.required' => 'Nama produk wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'berat.required' => 'Berat wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'gambar.required' => 'Gambar wajib diisi',
        ]);

        $file           = $request->file('gambar');
        $tujuan_upload  = 'produk';
        $namaFile       = 'produk_' . date('YmdHis') . '.' . $file->getClientOriginalExtension();

        // upload file
        $file->move($tujuan_upload, $namaFile);

        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'berat' => $request->berat,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Berhasil menambahkan produk');
    }

    public function edit(Produk $produk)
    {
        return view('admin.produk-form', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'Nama produk wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'berat.required' => 'Berat wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
        ]);

        DB::beginTransaction();
        try {
            if ($request->file('gambar')) {
                $file           = $request->file('gambar');
                $tujuan_upload  = 'produk';
                $namaFile       = 'produk_' . date('YmdHis') . '.' . $file->getClientOriginalExtension();

                // upload file
                $file->move($tujuan_upload, $namaFile);

                unlink(public_path('produk/' . $produk->gambar));
                $produk->gambar = $namaFile;
            }

            $produk->nama = $request->nama;
            $produk->harga = $request->harga;
            $produk->berat = $request->berat;
            $produk->deskripsi = $request->deskripsi;
            $produk->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengubah produk');
        }

        return redirect()->route('admin.produk.index')->with('success', 'Berhasil mengubah produk');
    }

    public function destroy(Produk $produk)
    {
        DB::beginTransaction();
        try {
            unlink(public_path('produk/' . $produk->gambar));
            $produk->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus produk');
        }

        return redirect()->route('admin.produk.index')->with('success', 'Berhasil menghapus produk');
    }

}
