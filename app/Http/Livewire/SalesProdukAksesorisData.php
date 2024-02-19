<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SalesProdukAksesorisData extends Component
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
        $accessories_count = Product::where('categories_id', '=', '3')->count();
        return view('livewire.sales-produk-aksesoris-data', [
            'accessories_count' => $accessories_count,
            'products' => $this->search === null ?
                Product::latest()->where('categories_id', '=', '3')->paginate($this->paginate) :
                Product::latest()->where('categories_id', '=', '3')->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
