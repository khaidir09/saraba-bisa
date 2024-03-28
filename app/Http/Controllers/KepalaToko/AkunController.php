<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Type;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\UserRequest;

class AkunController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $users = User::with('type')->paginate(10);
        $users_count = User::all()->count();
        $workers = Worker::all();
        return view('pages/kepalatoko/akun', compact('users', 'users_count', 'types', 'workers'));
    }

    public function deleteSelected(Request $request)
    {
        $selectedIds  = $request->input('selectedIds');

        $hasRelation = User::whereIn('id', $selectedIds)
            ->where(function ($query) {
                $query->whereHas('relasiService')
                ->orWhereHas('relasiSale')->orWhereHas('expense')->orWhereHas('salary');
            })
            ->exists();

        if ($hasRelation) {
            return response()->json(['message' => 'Data Akun yang memiliki riwayat transaksi tidak bisa dihapus.']);
        }

        User::whereIn('id', $selectedIds)->delete();
        return response()->json(['message' => 'Data Akun berhasil dihapus.']);
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('akun');
    }

    public function edit($id)
    {
        $item = User::with('worker')->findOrFail($id);
        $types = Type::all();
        $users = User::paginate(10);
        $users_count = User::all()->count();
        $workers = Worker::all();

        return view('pages.kepalatoko.akun-edit', [
            'types' => $types,
            'item' => $item,
            'users' => $users,
            'workers' => $workers,
            'users_count' => $users_count
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = User::findOrFail($id);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item->update($data);

        return redirect()->route('akun');
    }

    public function destroy($id)
    {
        $item = User::findOrFail($id);

        $item->delete();

        toast('Data Akun berhasil dihapus.', 'success');

        return redirect()->route('akun');
    }
}
