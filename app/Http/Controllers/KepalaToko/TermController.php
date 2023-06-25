<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
{

    public function index()
    {
        $termterima = Term::find(1);
        $termpengambilan = Term::find(2);
        $termpenjualan = Term::find(3);
        return view('pages/kepalatoko/pengaturan/syarat-ketentuan', compact(
            'termterima',
            'termpengambilan',
            'termpenjualan'
        ));
    }

    // make function update
    public function updateterima(Request $request)
    {
        $item = Term::find(1);

        // make function update
        $item->update([
            'description' => $request->description
        ]);

        // redirect back
        return redirect()->back();
    }

    public function updatepengambilan(Request $request)
    {
        $item = Term::find(2);

        // make function update
        $item->update([
            'description' => $request->description
        ]);

        // redirect back
        return redirect()->back();
    }

    public function updatepenjualan(Request $request)
    {
        $item = Term::find(3);

        // make function update
        $item->update([
            'description' => $request->description
        ]);

        // redirect back
        return redirect()->back();
    }
}
