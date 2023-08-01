<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductUpdate;
use Livewire\Component;
use Livewire\WithPagination;

class ProdukUpdateData extends Component
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
        $products = Product::all();
        $products_count = ProductUpdate::all()->count();
        return view('livewire.produk-update-data', [
            'products' => $products,
            'products_count' => $products_count,
            'product_updates' => $this->search === null ?
                ProductUpdate::latest()->paginate($this->paginate) :
                ProductUpdate::latest()->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
