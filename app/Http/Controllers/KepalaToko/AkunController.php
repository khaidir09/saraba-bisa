<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\UserRequest;
use App\Models\Worker;

class AkunController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $users_count = User::all()->count();
        $workers = Worker::all();
        return view('pages/kepalatoko/akun', compact('users', 'users_count', 'workers'));
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
        $users = User::paginate(10);
        $users_count = User::all()->count();
        $workers = Worker::all();

        return view('pages.kepalatoko.akun-edit', [
            'item' => $item,
            'users' => $users,
            'users_count' => $users_count,
            'workers' => $workers
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

        if (
            $item->relasiService()->exists() || $item->relasiSale()->exists()
            || $item->relasiAssembly()->exists() || $item->incident()->exists() || $item->expense()->exists()
            || $item->salary()->exists()
        ) {
            toast('Data Akun yang memiliki riwayat transaksi tidak bisa dihapus.', 'error');
            return redirect()->back();
        }

        $item->delete();

        toast('Data Akun berhasil dihapus.', 'success');

        return redirect()->route('akun');
    }
}
