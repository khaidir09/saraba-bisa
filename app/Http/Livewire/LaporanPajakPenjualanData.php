<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\OrderDetail;
use App\Models\StoreSetting;
use Livewire\WithPagination;

class LaporanPajakPenjualanData extends Component
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
        $jumlah = OrderDetail::where('ppn', '>', 0)->sum('quantity');
        $toko = StoreSetting::find(1);
        return view('livewire.laporan-pajak-penjualan-data', [
            'toko' => $toko,
            'jumlah' => $jumlah,
            'product_transactions' => $this->search === null ?
                OrderDetail::latest()->where('ppn', '>', 0)->paginate($this->paginate) :
                OrderDetail::latest()->where('ppn', '>', 0)->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
