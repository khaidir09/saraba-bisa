<?php

namespace App\Http\Livewire;

use App\Models\Accessory;
use App\Models\AccessoryTransaction;
use App\Models\Type;
use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use Barryvdh\DomPDF\PDF;
use Livewire\WithPagination;

class TransaksiAksesoris extends Component
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
        $accessories = Accessory::where('stok', '>=', '1')->get();
        $accessory_transactions = AccessoryTransaction::with('customer', 'accessory')->paginate(10);
        $accessory_transactions_count = AccessoryTransaction::all()->count();

        return view('livewire.transaksi-aksesoris', [
            'accessories' => $accessories,
            'accessory_transactions' => $accessory_transactions,
            'accessory_transactions_count' => $accessory_transactions_count,
            'accessory_transactions' => $this->search === null ?
                AccessoryTransaction::latest()->paginate($this->paginate) :
                AccessoryTransaction::latest()->where('nomor_transaksi', 'like', '%' . $this->search . '%')->paginate($this->paginate)
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
