<?php

namespace App\Http\Controllers;
use App\Models\Keranjang;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function store(Request $request)
        {
        
        $user = auth('user')->user();

        $request->validate([
            'id_menu' => 'required',   
        ]);

        $keranjang = Keranjang::where('id_menu', $request->id_menu)
                            ->where('id_user', $user->id_user)->where('status', 'OnGoing')
                            ->first();
                            
        if ($keranjang) {
            $keranjang->jumlah_menu += 1;
            $keranjang->save();  
        } else {
            Keranjang::create([
                'id_menu' => $request->id_menu,
                'id_user' => $user->id_user,
                'jumlah_menu' => 1,  
                'status' => 'OnGoing',
            ]);
        }
        return redirect()->route('menu')->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }

    public function storeHistory(){
        $user = auth('user')->user();
        $keranjangs = Keranjang::where('id_user', $user->id_user)->where('status','OnGoing')->get();
        foreach ($keranjangs as $keranjang) {
            $history = Keranjang::where('id_menu', $keranjang->id_menu)
                            ->where('id_user', $user->id_user)
                            ->where('status', 'Done')->first();
            if($history){
                $history->jumlah_menu+= $keranjang->jumlah_menu;
                $keranjang->status = 'Done';
                $keranjang->save();
                $keranjang->delete();
                $history->save();
            }else{
                $keranjang->status = 'Done';
                $keranjang->save();
            }
        }
        return redirect()->route('pembayaranBerhasil')->with('success', 'Pembayaran berhasil, pesanan disimpan ke history.');
    }
    
    public function showHistory(){
        $user = auth('user')->user();
        $keranjangs = Keranjang::where('id_user', $user->id_user)->where('status', 'Done')->get();
        return view('user/main/history', compact('keranjangs'));
    }

    public function delete($id_keranjang)
    {
        $keranjang = Keranjang::findOrFail($id_keranjang);
        if($keranjang->jumlah_menu> 1){
            $keranjang->jumlah_menu -= 1;
            $keranjang->save();
            return redirect()->route('pembayaran')->with('success', 'Menu dikurang dari keranjang');
        } else {
            $keranjang->delete();
            return redirect()->route('pembayaran')->with('success', 'Menu berhasil dihapus dari keranjang');
        }
    }

    public function deleteAll()
    {
        $user = auth('user')->user();
        $keranjang = Keranjang::where('id_user', $user->id_user)->where('status', 'OnGoing')->get();
        foreach ($keranjang as $item) {
            $item->delete();
        }
        return redirect()->route('pembayaran')->with('success', 'Semua menu berhasil dihapus dari keranjang');
        
    }
}

