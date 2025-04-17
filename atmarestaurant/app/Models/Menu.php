<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'id_pemesanan',
        'nama',
        'harga',
        'jenis',
        'gambar_makanan',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

}
