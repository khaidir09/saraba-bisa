<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        if ($request->hasFile('profile_photo_path')) {
            $data['profile_photo_path'] = $request->file('profile_photo_path')->store('assets/user', 'public');
        }

        $item->update($data);

        return redirect()->route('informasi-toko');
    }
}
