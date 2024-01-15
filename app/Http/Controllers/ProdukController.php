<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::query()
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('produk', compact('produk'));
    }

    public function show($product)
    {
        $produk = Produk::findOrFail($product);

        return view('produk-detail', compact('produk'));
    }
}
