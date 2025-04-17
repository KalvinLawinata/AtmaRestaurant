<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class MenuController extends Controller
{

    public function indexAdmin()
    {
        $menu = Menu::all();

        return view('Admin.admin_menu', compact('menu'))->with('success', session('success'))->with('error', session('error'));
    }

    public function indexUser()
    {
        $menu = Menu::all();

        return view('/user/main/menu', compact('menu'));
    }

    public function showMenu($jenis = 'all')
    {
        if ($jenis == 'Rice') {
            $menu = Menu::where('jenis', 'Rice')->get();
        } elseif ($jenis == 'Drink') {
            $menu = Menu::where('jenis', 'Drink')->get();
        } elseif ($jenis == 'Noodle') {
            $menu = Menu::where('jenis', 'Noodle')->get();
        } else {
            $menu = Menu::all();
        }

        return view('user.main.menu', compact('menu'));
    }

    public function edit($id_menu)
    {
        $menu = Menu::findOrFail($id_menu);

        return view('Admin.admin_editMenu', compact('menu'));
    }

    public function find(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $menu = Menu::where('nama', 'like', '%' . $request->search . '%')->get();
        
        return view('/user/main/menu', compact('menu'));
    }

    public function store(Request $request)
    {
        $jenis = ['Rice', 'Noodle', 'Drink'];

        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'gambar_makanan' => 'nullable|image',
            'jenis' => 'required',
        ]);

        $imagePath = '';
        if ($request->hasFile('gambar_makanan')) {
            $image = $request->file('gambar_makanan');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        if (!in_array($request->jenis, $jenis)) {
            return redirect()->route('admin_menu')->with('error', 'Jenis menu tidak valid');
        } else {
            Menu::create([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'gambar_makanan' => $imagePath,
                'jenis' => $request->jenis,
            ]);
            return redirect()->route('admin_menu')->with('success', 'Berhasil membuat menu');
        }
    }

    public function update(Request $request, $id_menu)
    {
        $jenis = ['Rice', 'Noodle', 'Drink'];

        $menu = Menu::findOrFail($id_menu);

        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'gambar_makanan' => 'nullable|image',
            'jenis' => 'required',
        ]);

        $imageLama = $menu->gambar_makanan;

        $imagePath = $imageLama;

        if (!in_array($request->jenis, $jenis)) {
            return redirect()->route('admin_menu')->with('error', 'Jenis menu tidak valid');
        } else {
            if ($request->hasFile('gambar_makanan')) {
                $image = $request->file('gambar_makanan');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                File::delete(public_path($imageLama));
            }

            $menu->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'gambar_makanan' => $imagePath,
                'jenis' => $request->jenis,
                'jumlah_menu' => 0,
            ]);
            return redirect()->route('admin_menu')->with('success', 'Berhasil mengupdate menu');
        }
    }

    public function destroy($id_menu)
    {
        $menu = Menu::find($id_menu);
        File::delete(public_path($menu->gambar_makanan));
        $menu->delete();
        return redirect()->intended('admin_menu')->with('success', 'Berhasil menghapus menu');
    }
}
