<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pemesanan;
use App\Models\Menu;

class PesananController extends Controller
{
    public function indexAll()
    {
        // You might want to pass data to the view (e.g., existing reservations)
        $pesananList = Pesanan::all();

        return view('user.main.pembayaran', compact('pesananList'));
    }

    public function store(Request $request, Pemesanan $pemesanan, Menu $menu)
    {
        $user = auth('user')->user();

        Pesanan::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'id_menu' => $menu->id_menu,
            'jumlah_menu' => $request->jumlah_menu,
        ]);

        return redirect()->back()->with('success', 'Pesanan Berhasil');
    }

}
