<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Keranjang;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function content()
    {
        $reservasiChart = [];
        for ($month = 1; $month <= 12; $month++) {
            $count = Reservasi::whereMonth('tanggal_reservasi', $month)
                ->whereYear('tanggal_reservasi', Carbon::now()->year)
                ->count();
            $reservasiChart[] = $count;
        }
        $order = Keranjang::where('status', 'Done')->get()->count();
        $reservasi = Reservasi::all()->count();
        $user = User::whereMonth('tanggal_register', Carbon::now()->month)->count();
        $earning = Keranjang::where('status', 'Done')
            ->with('menu')
            ->get()
            ->sum(function ($order) {
                return $order->jumlah_menu * $order->menu->harga;
            });
        $content = [
            'order' => $order,
            'reservasi' => $reservasi,
            'user' => $user,
            'earning' => $earning,
        ];
        return view('Admin.admin_dashboard_content', compact('content'), ['reservasiChart' => $reservasiChart]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
