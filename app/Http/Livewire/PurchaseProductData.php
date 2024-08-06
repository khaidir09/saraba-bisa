<?php

namespace App\Http\Livewire;

use App\Models\Purchase;
use App\Models\Retur;
use Livewire\Component;
use Livewire\WithPagination;

class PurchaseProductData extends Component
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
        $purchases_count = Purchase::whereNull('keterangan')
            ->orWhere('keterangan', '!=', 'Tukar Tambah')->count();
        $returs_count = Retur::all()->count();
        $trade_ins_count = Purchase::where('keterangan', '=', 'Tukar Tambah')->count();
        return view('livewire.purchase-product-data', [
            'purchases_count' => $purchases_count,
            'returs_count' => $returs_count,
            'trade_ins_count' => $trade_ins_count,
            'purchases' => $this->search === null ?
                Purchase::latest()->whereNull('keterangan')
                ->orWhere('keterangan', '!=', 'Tukar Tambah')->paginate($this->paginate) :
                Purchase::latest()->where('reference_number', 'like', '%' . $this->search . '%')->orWhere('suppliers_name', 'like', '%' . $this->search . '%')->orWhere('product_name', 'like', '%' . $this->search . '%')->where(function ($query) {
                    $query->whereNull('keterangan')
                        ->orWhere('keterangan', '!=', 'Tukar Tambah');
                })->paginate($this->paginate)
        ]);
    }
}
