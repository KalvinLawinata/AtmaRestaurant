<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasiList = Reservasi::all();

        return view('user.main.reservasi', compact('reservasiList'));
    }

    public function store(Request $request)
    {
        $user = auth('user')->user();

        $request->validate([
            'jumlah_orang' => 'required',
            'tanggal_reservasi' => 'required',
            'waktu_reservasi' => 'required',
        ]);

        Reservasi::create([
            'id_user' => $user->id_user,
            'jumlah_orang' => $request->jumlah_orang,
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'waktu_reservasi' => $request->waktu_reservasi,
        ]);

        return redirect()->intended('pemesanan')->with('success', 'Reservasi Berhasil');
    }
}
