<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Accessory;
use Livewire\WithPagination;
use App\Models\AccessoryTransaction;
use Illuminate\Support\Facades\Auth;

class SalesLaporanAksesoris extends Component
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
        $jumlah = AccessoryTransaction::where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->sum('quantity');
        return view('livewire.sales-laporan-aksesoris', [
            'jumlah' => $jumlah,
            'accessories' => $accessories,
            'users' => $users,
            'customers' => $customers,
            'accessory_transactions' => $this->search === null ?
                AccessoryTransaction::latest()->where('users_id', Auth::user()->id)->where('is_approve', 'Setuju')->paginate($this->paginate) :
                AccessoryTransaction::latest()->where('users_id', Auth::user()->id)->where('is_approve', 'Setuju')->where('nomor_transaksi', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
