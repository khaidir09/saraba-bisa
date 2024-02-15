<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Category;
use App\Models\ModelSerie;
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
        $categories = Category::all();
        $spareparts = SubCategory::where('categories_id', '=', '2')->get();
        $accecories = SubCategory::where('categories_id', '=', '3')->get();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $products_count = Product::all()->count();
        $toko = StoreSetting::find(1);
        return view('livewire.produk-data', [
            'brands' => $brands,
            'capacities' => $capacities,
            'model_series' => $model_series,
            'toko' => $toko,
            'categories' => $categories,
            'spareparts' => $spareparts,
            'accecories' => $accecories,
            'products_count' => $products_count,
            'products' => $this->search === null ?
                Product::latest()->paginate($this->paginate) :
                Product::latest()->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
