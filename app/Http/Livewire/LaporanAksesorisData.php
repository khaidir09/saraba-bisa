<?php

namespace App\Http\Livewire;

use App\Models\Accessory;
use App\Models\AccessoryTransaction;
use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class LaporanAksesorisData extends Component
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
        $users = User::all();
        $customers = Customer::all();
        $accessories = Accessory::all();
        $jumlah = AccessoryTransaction::where('is_approve', 'Setuju')->sum('quantity');
        return view('livewire.laporan-aksesoris-data', [
            'jumlah' => $jumlah,
            'accessories' => $accessories,
            'users' => $users,
            'customers' => $customers,
            'accessory_transactions' => $this->search === null ?
                AccessoryTransaction::latest()->where('is_approve', 'Setuju')->paginate($this->paginate) :
                AccessoryTransaction::latest()->where('is_approve', 'Setuju')->where('nomor_transaksi', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
