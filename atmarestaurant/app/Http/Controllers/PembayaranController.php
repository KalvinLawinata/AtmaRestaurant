<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pembayaran;

class PembayaranController extends Controller
{
    public function indexAdmin(){
        $pembayaran = Pembayaran::all();

        return view('Admin.admin_menu', compact('pembayaran'));
    }
    
    public function indexUser(){
        $pembayaran = Pembayaran::all();
        return view('/user/main/menu', compact('pembayaran'));
    }

}
