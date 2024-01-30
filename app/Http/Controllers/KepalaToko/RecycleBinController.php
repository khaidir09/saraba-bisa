<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class RecycleBinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service()
    {
        return view('pages/kepalatoko/keranjang-sampah/servis');
    }

    public function permanentlyDelete($id)
    {
        $item = ServiceTransaction::withTrashed()->findOrFail($id);

        $item->forceDelete();

        toast('Data servis berhasil dihapus secara permanen.', 'success');

        return redirect()->route('keranjang-servis');
    }

    public function restore($id)
    {
        $item = ServiceTransaction::withTrashed()->findOrFail($id);

        $item->restore();

        toast('Data servis berhasil dipulihkan.', 'success');

        return redirect()->route('keranjang-servis');
    }

    public function cleanService()
    {
        // Mengambil semua data yang telah dihapus
        $items = ServiceTransaction::onlyTrashed()->get();

        // Melakukan penghapusan permanen untuk setiap data yang telah dihapus
        foreach ($items as $item) {
            $item->forceDelete();
        }

        toast('Semua keranjang sampah data servis berhasil dibersihkan.', 'success');

        return redirect()->route('keranjang-servis');
    }

    public function account()
    {
        return view('pages/kepalatoko/keranjang-sampah/akun');
    }

    public function permanentlyDeleteAccount($id)
    {
        $item = User::withTrashed()->findOrFail($id);

        $item->forceDelete();

        toast('Data akun berhasil dihapus secara permanen.', 'success');

        return redirect()->route('keranjang-akun');
    }

    public function restoreAccount($id)
    {
        $item = User::withTrashed()->findOrFail($id);

        $item->restore();

        toast('Data akun berhasil dipulihkan.', 'success');

        return redirect()->route('keranjang-akun');
    }

    public function cleanAccount()
    {
        // Mengambil semua data yang telah dihapus
        $items = User::onlyTrashed()->get();

        // Melakukan penghapusan permanen untuk setiap data yang telah dihapus
        foreach ($items as $item) {
            $item->forceDelete();
        }

        toast('Semua keranjang sampah data akun berhasil dibersihkan.', 'success');

        return redirect()->route('keranjang-akun');
    }

    public function customer()
    {
        return view('pages/kepalatoko/keranjang-sampah/pelanggan');
    }

    public function permanentlyDeleteCustomer($id)
    {
        $item = Customer::withTrashed()->findOrFail($id);

        $item->forceDelete();

        toast('Data pelanggan berhasil dihapus secara permanen.', 'success');

        return redirect()->route('keranjang-pelanggan');
    }

    public function restoreCustomer($id)
    {
        $item = Customer::withTrashed()->findOrFail($id);

        $item->restore();

        toast('Data pelanggan berhasil dipulihkan.', 'success');

        return redirect()->route('keranjang-pelanggan');
    }

    public function cleanCustomer()
    {
        // Mengambil semua data yang telah dihapus
        $items = Customer::onlyTrashed()->get();

        // Melakukan penghapusan permanen untuk setiap data yang telah dihapus
        foreach ($items as $item) {
            $item->forceDelete();
        }

        toast('Semua keranjang sampah data pelanggan berhasil dibersihkan.', 'success');

        return redirect()->route('keranjang-pelanggan');
    }
}
