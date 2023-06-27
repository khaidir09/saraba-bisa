<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\OrderDetail;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class SalesLaporanPenjualanData extends Component
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
        $jumlah = OrderDetail::where('users_id', Auth::user()->id)->sum('quantity');
        return view('livewire.sales-laporan-penjualan-data', [
            'jumlah' => $jumlah,
            'product_transactions' => $this->search === null ?
                OrderDetail::latest()->where('users_id', Auth::user()->id)->paginate($this->paginate) :
                OrderDetail::latest()->where('users_id', Auth::user()->id)->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
