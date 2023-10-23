<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class TeknisiProdukData extends Component
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
        $products_count = Product::where('category_name','like', '%sparepart')->count();
        return view('livewire.teknisi-produk-data', [
            'products_count' => $products_count,
            'products' => $this->search === null ?
                Product::latest()->where('category_name', 'like', '%sparepart')->paginate($this->paginate) :
                Product::latest()->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
