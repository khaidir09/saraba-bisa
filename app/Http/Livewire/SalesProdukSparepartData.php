<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SalesProdukSparepartData extends Component
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
        $spareparts_count = Product::where('categories_id', '=', '2')->count();
        return view('livewire.sales-produk-sparepart-data', [
            'spareparts_count' => $spareparts_count,
            'products' => $this->search === null ?
                Product::latest()->where('categories_id', '=', '2')->paginate($this->paginate) :
                Product::latest()->where('categories_id', '=', '2')->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
