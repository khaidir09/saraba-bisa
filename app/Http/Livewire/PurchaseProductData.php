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
        $purchases_count = Purchase::all()->count();
        $returs_count = Retur::all()->count();
        return view('livewire.purchase-product-data', [
            'purchases_count' => $purchases_count,
            'returs_count' => $returs_count,
            'purchases' => $this->search === null ?
                Purchase::latest()->paginate($this->paginate) :
                Purchase::latest()->where('reference_number', 'like', '%' . $this->search . '%')->orWhere('suppliers_name', 'like', '%' . $this->search . '%')->orWhere('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
