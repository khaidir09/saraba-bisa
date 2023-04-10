<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\UserRequest;

class AkunController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $users_count = User::all()->count();
        return view('pages/kepalatoko/akun', compact('users', 'users_count'));
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
        $item = User::findOrFail($id);
        $users = User::paginate(10);
        $users_count = User::all()->count();

        return view('pages.kepalatoko.akun-edit', [
            'item' => $item,
            'users' => $users,
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

        return redirect()->route('akun');
    }
}
