<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\SparepartRequest;

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::paginate(10);
        $spareparts_count = Sparepart::all()->count();
        return view('pages/kepalatoko/sparepart/index', compact('spareparts', 'spareparts_count'));
    }

    public function store(SparepartRequest $request)
    {
        $data = $request->all();

        Sparepart::create($data);

        return redirect()->route('data-sparepart.index');
    }

    public function edit($id)
    {
        $item = Sparepart::findOrFail($id);

        return view('pages.kepalatoko.sparepart.edit', [
            'item' => $item
        ]);
    }

    public function update(SparepartRequest $request, $id)
    {
        $data = $request->all();

        $item = Sparepart::findOrFail($id);

        $item->update($data);

        return redirect()->route('data-sparepart.index');
    }

    public function destroy($id)
    {
        $item = Sparepart::findOrFail($id);

        $item->delete();

        return redirect()->route('data-sparepart.index');
    }
}
