<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\ModelSerie;
use App\Models\SubCategory;
use App\Models\StoreSetting;
use Livewire\WithPagination;

class AdminProdukAksesorisData extends Component
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
        $accessories = SubCategory::where('categories_id', '=', '3')->get();
        $model_series = ModelSerie::all();
        $toko = StoreSetting::find(1);
        $accessories_count = Product::where('categories_id', '=', '3')->count();
        return view('livewire.admin-produk-aksesoris-data', [
            'toko' => $toko,
            'accessories' => $accessories,
            'model_series' => $model_series,
            'accessories_count' => $accessories_count,
            'products' => $this->search === null ?
                Product::latest()->where('categories_id', '=', '3')->paginate($this->paginate) :
                Product::latest()->where('categories_id', '=', '3')->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
