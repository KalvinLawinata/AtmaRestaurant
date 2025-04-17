<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'history';
    protected $primaryKey = 'id_history';

    protected $fillable = [
        'id_keranjang',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function menu()
    {
        return $this->hasOneThrough(Menu::class, Keranjang::class, 'id_keranjang', 'id_menu', 'id_keranjang', 'id_menu');
    }
    
    public function keranjang(){
        return $this->belongsTo(Keranjang::class, 'id_keranjang');
    }
}
