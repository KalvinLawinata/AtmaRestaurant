<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $user = auth('user')->user();

        $keranjang = Keranjang::with('menu')
            ->where('id_user', $user->id_user)->where('status', 'OnGoing')
            ->get();

        $history = Keranjang::where('id_user', $user->id_user)->where('status', 'Done')->get();

        return view('user/main/profile', compact('user', 'keranjang', 'history'));
    }

    public function indexAll()
    {
        $user = User::orderBy('id_user', 'desc')->paginate(3);
        $userCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $count = User::whereMonth('tanggal_register', $month)
                ->whereYear('tanggal_register', Carbon::now()->year)
                ->count();

            $userCounts[] = $count;
        }

        return view('Admin.admin_user', compact('user'), ['userCounts' => $userCounts]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string',
            'no_telp' => 'required|string',
            'tgl_lahir' => 'required',
        ]);

        $fotoPath = 'user_profile/default.jpeg';

        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_telp' => $request->no_telp,
                'tgl_lahir' => $request->tgl_lahir,
                'foto' => $fotoPath,
                'tanggal_register' => now(),
            ]);
            return redirect()->intended('login')->with('success', 'Berhasil membuat user');
        } catch (Exception $e) {
            return redirect()->intended('sign-up')->with('error', 'Gagal membuat user');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admins = Admin::where('username', $request->username)->first();

        if ($admins && $request->password == $admins->password) {
            Auth::guard('admin')->login($admins);
            return redirect()->intended('admin_dashboard')->with('success', 'Berhasil login');
        } else {
            $users = User::where('username', $request->username)->first();
            if (!$users || !Hash::check($request->password, $users->password)) {
                return redirect()->intended('login')->with('failed', 'Akun tidak ditemukan');
            }
            Auth::guard('user')->login($users);
            return redirect()->intended('/')->with('success', 'Berhasil login');
        }
    }

    function edit($id_user)
    {
        $user = User::findOrFail($id_user);
        return view('user/main/edit', compact('user'));
    }

    public function updateProfile(Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);
        
        $request->validate([
            'username' => 'required|string|max:255|unique:user,username,' . $user->id_user . ',id_user',
            'email' => 'required|string|email|max:255|unique:user,email,' . $user->id_user . ',id_user',
            'no_telp' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $fotoLama = $user->foto;
            if($fotoLama != 'user_profile/default.jpeg'){
                File::delete(public_path($fotoLama));
            }
            $file = $request->file('foto'); 
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('user_profile'), $fileName);
            $fotoPath = 'user_profile/' . $fileName;
            
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'foto' => $fotoPath,
            ]);
        }else{
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
            ]);
        }

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }


    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/');
    }

    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->delete();

        return redirect()->route('admin_user')->with('success', 'Berhasil menghapus user');
    }

    // public function showChart()
    // {
    //     $userCounts = [];

    //     for ($month = 1; $month <= 12; $month++) {
    //         $count = User::whereMonth('tanggal_register', $month)
    //             ->whereYear('tanggal_register', Carbon::now()->year)
    //             ->count();

    //         $userCounts[] = $count;
    //     }
    //     return view('admin_user', ['userCounts' => $userCounts]);
    // }
}
