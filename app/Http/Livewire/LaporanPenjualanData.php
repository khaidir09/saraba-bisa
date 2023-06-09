<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Phone;
use Livewire\Component;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\PhoneTransaction;
use Livewire\WithPagination;

class LaporanPenjualanData extends Component
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
        $jumlah = OrderDetail::all()->sum('quantity');
        return view('livewire.laporan-penjualan-data', [
            'jumlah' => $jumlah,
            'product_transactions' => $this->search === null ?
                OrderDetail::latest()->paginate($this->paginate) :
                OrderDetail::latest()->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
