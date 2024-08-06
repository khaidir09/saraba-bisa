<?php

namespace App\Http\Livewire;

use App\Models\Purchase;
use App\Models\Retur;
use Livewire\Component;
use Livewire\WithPagination;

class ReturProductData extends Component
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
        $purchases = Purchase::all();
        $returs_count = Retur::all()->count();
        $purchases_count = Purchase::whereNull('keterangan')
            ->orWhere('keterangan', '!=', 'Tukar Tambah')->count();
        $trade_ins_count = Purchase::where('keterangan', '=', 'Tukar Tambah')->count();

        return view('livewire.retur-product-data', [
            'purchases' => $purchases,
            'returs_count' => $returs_count,
            'purchases_count' => $purchases_count,
            'trade_ins_count' => $trade_ins_count,
            'returs' => $this->search === null ?
                Retur::latest()->paginate($this->paginate) :
                Retur::latest()->where('reference_number', 'like', '%' . $this->search . '%')->orWhere('suppliers_name', 'like', '%' . $this->search . '%')->orWhere('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
