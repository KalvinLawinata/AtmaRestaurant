<?php

namespace App\Http\Controllers;
use App\Models\History;
use App\Models\Keranjang;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function storeHistory()
    {   
        $user = auth('user')->user();

        $keranjangs = Keranjang::where('id_user', $user->id_user)->get();

        foreach ($keranjangs as $keranjang) {
            $history = History::where('id_menu', $keranjang->id_menu)
                            ->where('id_user', $user->id_user)
                            ->first();

            if ($history) {
                $history->jumlah_menu += $keranjang->jumlah_menu;
                $history->save();
            } else {
                $history = History::create([
                    'id_keranjang' => $keranjang->id_keranjang,
                    'id_user' => $user->id_user,
                    'id_menu' => $keranjang->id_menu,
                    'jumlah_menu' => $keranjang->jumlah_menu,
                ]);
                if (!$history) {
                    return redirect()->route('menu')->with('error', 'Gagal menyimpan ke history.');
                }
            }
        }

        Keranjang::where('id_user', $user->id_user)->delete();
        return redirect()->route('menu')->with('success', 'Pembayaran berhasil, pesanan disimpan ke history.');
    }
}
