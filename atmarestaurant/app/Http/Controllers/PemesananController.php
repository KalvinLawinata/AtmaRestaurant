<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
    {
        // You might want to pass data to the view (e.g., existing reservations)
        $pemesananList = Pemesanan::all();

        return view('user.main.pembayaran', compact('pemesananList'));
    }

    public function store(Request $request)
    {
        $user = auth('user')->user();

        Pemesanan::create([
            'id_user' => $user->id_user,
            'id_pembayaran' => $request->jumlah_orang,
            'status' => $request->tanggal_reservasi,
            'waktu_reservasi' => $request->waktu_reservasi,
        ]);

        return redirect()->intended('pemesanan')->with('success', 'Reservasi Berhasil');
    }
}
