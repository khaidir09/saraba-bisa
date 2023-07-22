<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InformasiTokoController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        return view('pages/kepalatoko/pengaturan/profil', compact('users'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $item = Auth::user();

        // Lakukan validasi file jika ada
        if ($request->hasFile('profile_photo_path')) {
            $validator = Validator::make($request->all(), [
                'profile_photo_path' => 'file|mimes:png',
            ]);

            if ($validator->fails()) {
                toast('Gambar Logo harus menggunakan format PNG.', 'error');
                return redirect()->back();
            }

            // Jika validasi berhasil, simpan file ke direktori public/storage/assets/user
            $data['profile_photo_path'] = $request->file('profile_photo_path')->store('assets/user', 'public');
        }

        $item->update($data);

        return redirect()->route('informasi-toko');
    }
}
