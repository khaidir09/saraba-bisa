<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\SubCategory;
use Livewire\WithPagination;

class ProdukHabisData extends Component
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
        $categories = SubCategory::all();
        $products_count = Product::where('stok', '=', '0')->count();
        return view('livewire.produk-habis-data', [
            'categories' => $categories,
            'products_count' => $products_count,
            'products' => $this->search === null ?
                Product::latest()->where('stok', '=', '0')->paginate($this->paginate) :
                Product::latest()->where('stok', '=', '0')->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
