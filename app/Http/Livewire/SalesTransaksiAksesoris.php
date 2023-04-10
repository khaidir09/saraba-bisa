<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use Barryvdh\DomPDF\PDF;
use App\Models\Accessory;
use Livewire\WithPagination;
use App\Models\AccessoryTransaction;
use Illuminate\Support\Facades\Auth;

class SalesTransaksiAksesoris extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $accessories = Accessory::all();
        $users = Auth::user()->id;
        $accessory_transactions = AccessoryTransaction::with('user', 'customer', 'accessory')->where('users_id', Auth::user()->id)->paginate(10);
        $accessory_transactions_count = AccessoryTransaction::all()->count();

        return view('livewire.sales-transaksi-aksesoris', [
            'accessories' => $accessories,
            'users' => $users,
            'accessory_transactions' => $accessory_transactions,
            'accessory_transactions_count' => $accessory_transactions_count,
            'accessory_transactions' => $this->search === null ?
                AccessoryTransaction::latest()->where('users_id', Auth::user()->id)->where('is_admin_toko', null)->paginate($this->paginate) :
                AccessoryTransaction::latest()->where('users_id', Auth::user()->id)->where('is_admin_toko', null)->where('nomor_transaksi', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }

    public function cetak($id)
    {
        $items = AccessoryTransaction::findOrFail($id);
        $customers = Customer::all();
        $accessories = Accessory::all();
        $users = User::find(1);

        $pdf = PDF::loadView('pages.kepalatoko.cetak', [
            'users' => $users,
            'items' => $items,
            'customers' => $customers,
            'accessories' => $accessories
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function cetaktermal($id)
    {
        $items = AccessoryTransaction::findOrFail($id);
        $customers = Customer::all();
        $accessories = Type::all();
        $users = User::find(1);

        $pdf = PDF::loadView('pages.kepalatoko.cetak-termal', [
            'users' => $users,
            'items' => $items,
            'customers' => $customers,
            'accessories' => $accessories
        ])->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
