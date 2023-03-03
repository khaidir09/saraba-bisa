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

class AdminTransaksiAksesoris extends Component
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
        $users = User::where('role', 'Sales')->get();
        $accessory_transactions_count = AccessoryTransaction::where('is_admin_toko', 'Admin')
            ->count();

        return view('livewire.admin-transaksi-aksesoris', [
            'accessories' => $accessories,
            'users' => $users,
            'accessory_transactions_count' => $accessory_transactions_count,
            'accessory_transactions' => $this->search === null ?
                AccessoryTransaction::latest()
                ->where('is_admin_toko', 'Admin')
                ->paginate($this->paginate) :
                AccessoryTransaction::latest()
                ->where('is_admin_toko', 'Admin')
                ->where('nomor_transaksi', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
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
