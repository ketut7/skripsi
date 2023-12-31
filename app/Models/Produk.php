<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'deskripsi',
        'berat',
        'harga',
        'gambar',
    ];

    public function getGambarUrlAttribute($value)
    {
        return asset('produk/' . $this->gambar);
    }
}
