<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'no_transaksi',
        'user_id',
        'alamat',
        'nomor_telepon',
        'status',
        'status_pengiriman',
        'bukti_pembayaran',
        'metode_pembayaran',
        'no_resi',
        'ongkir',
        'total_item',
        'total_harga'
    ];

    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
