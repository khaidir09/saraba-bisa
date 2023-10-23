<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\SubCategory;
use App\Models\StoreSetting;
use Livewire\WithPagination;

class ProdukData extends Component
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
        $products_count = Product::all()->count();
        $toko = StoreSetting::find(1);
        return view('livewire.produk-data', [
            'toko' => $toko,
            'categories' => $categories,
            'products_count' => $products_count,
            'products' => $this->search === null ?
                Product::latest()->paginate($this->paginate) :
                Product::latest()->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
