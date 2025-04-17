<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_user',
        'jumlah_orang',
        'tanggal_reservasi',
        'waktu_reservasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
