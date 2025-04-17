<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_pemesanan',
        'total_harga',
        'jenis_pembayaran',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
