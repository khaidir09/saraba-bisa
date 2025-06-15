<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SistemController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        return view('pages/kepalatoko/pengaturan/sistem', compact('users'));
    }

    public function update(Request $request)
    {
        $item = Auth::user();

        $data = $request->all();

        $item->update($data);

        return redirect()->route('sistem');
    }
}
