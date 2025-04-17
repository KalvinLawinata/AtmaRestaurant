<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KeranjangController;
use App\Models\Reservasi;
use App\Models\Keranjang;
use App\Http\Controllers\HistoryController;



Route::post('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/loginUser', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/logoutAdmin', [AdminController::class, 'logout'])->name('admin.logout');


Route::get('/', function () {
    return view('/user/homepage');
});

Route::get('sign-up', function () {
    if(Auth::guard('user')->check()){
        return redirect('/');
    }else if(Auth::guard('admin')->check()){
        return redirect('admin_dashboard');
    }
    return view('/user/sign-up');
});

Route::get('login', function () {
    if(Auth::guard('user')->check()){
        return redirect('/');
    }else if(Auth::guard('admin')->check()){
        return redirect('admin_dashboard');
    }
    return view('/user/login');
})->name('login');


Route::middleware(['auth:user'])->group(function () {

    Route::get('profile', [UserController::class, 'index'])->name('user.profile');
    
    // Route::get('edit', function () {
    //     $userId = Auth::id();
    //     $user = User::find($userId);
    //     return view('/user/main/edit', compact( 'user'));
    // });

    Route::post('updateProfile/{id_user}', [UserController::class, 'updateProfile'])->name('user.updateProfile');

    Route::post('reservasi', [ReservasiController::class, 'store'])->name('reservasi.create');

    Route::get('menu', [MenuController::class, 'indexUser'])->name('menu');
    Route::get('menu/{jenis}', [MenuController::class, 'showMenu']);
    Route::post('menu', [MenuController::class, 'find'])->name('menu.search');

    Route::get('pembayaran/user', [PembayaranController::class, 'indexUser']);
    Route::get('pembayaran/admin', [PembayaranController::class, 'indexAdmin']);

    Route::get('pesanan/all', [PesananController::class, 'indexAll']);
    Route::get('pesanan/store', [PesananController::class, 'store']);

    Route::post('addmenu', [KeranjangController::class, 'store'])->name('menu.addkeranjang');
    Route::post('addhistory', [KeranjangController::class, 'storeHistory'])->name('history.store');

    Route::get('edit/{id_user}', [UserController::class, 'edit'])->name('user.edit');

    Route::get('reservasi', function () {
        $user = auth('user')->user();

        $reservasi = Reservasi::where('id_user', $user->id_user)->first();
        
        if ($reservasi && $reservasi->tanggal_reservasi < now()) {
            $reservasi->delete();
            return redirect()->route('reservasi.create')->with('success', 'Reservasi sudah lewat dan telah dihapus.');
        }


        if (!$reservasi) {
            return view('/user/main/reservasi');
        }

        return redirect('menu');

    });

    Route::get('pembayaran', function () {
        $userId = auth('user')->user()->id_user;

        $keranjangs = Keranjang::with('menu')
        ->where('id_user', $userId)->where('status', 'OnGoing')
        ->get();

        $subtotal = $keranjangs->sum(function ($item) {
            return $item->jumlah_menu * $item->menu->harga;
        });

        $tax = $subtotal * 0.10;

        $total = $subtotal + $tax;

        return view('/user/main/pembayaran', compact('keranjangs', 'subtotal', 'tax', 'total'));
    })->name('pembayaran');

    Route::delete('deleteKeranjang/{id_keranjang}', [KeranjangController::class, 'delete'])->name('keranjang.delete');
    Route::delete('deleteKeranjangAll', [KeranjangController::class, 'deleteAll'])->name('keranjang.deleteAll');
    //---------------------------------------------------------------------------------------------------------------------------------


    Route::get('qris', function () {
        return view('/user/main/qris');
    });

    Route::get('virtual', function () {
        return view('/user/main/virtual');
    });

    Route::get('pembayaranBerhasil', function () {
        return view('Notif.pembayaranBerhasil');
    })->name('pembayaranBerhasil');

    Route::get('pemesanan', function () {
        return view('Notif.pemesanan');
    });
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin_dashboard', function () {
        return view('Admin.admin_dashboard');
    });

    Route::get('admin_dashboard_content', [AdminController::class, 'content'])->name('admin_dashboard_content');

    Route::get('admin_menu', [MenuController::class, 'indexAdmin'])->name('admin_menu');
    Route::post('menu_store', [MenuController::class, 'store'])->name('menu.store');
    
    Route::delete('admin_user/{id_user}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('admin_user', [UserController::class, 'indexAll'])->name('admin_user');


    Route::get('menu_edit/{id_menu}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::post('menu_update/{id_menu}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('menu_delete/{id_menu}', [MenuController::class, 'destroy'])->name('menu.delete');

    Route::get('admin_profile', function () {
        return view('Admin.admin_profile');
    });
});
