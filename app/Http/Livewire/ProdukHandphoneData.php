<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Category;
use App\Models\Color;
use App\Models\ModelSerie;
use App\Models\StoreSetting;
use Livewire\WithPagination;

class ProdukHandphoneData extends Component
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
        $toko = StoreSetting::find(1);
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $colors = Color::all();
        $handphoneitemready = Product::where('categories_id', 1)->where('stok', '>', 0)->count();
        $handphonestokready = Product::where('categories_id', 1)->where('stok', '>', 0)->sum('stok');
        $handphonemodalready = Product::where('categories_id', 1)->where('stok', '>', 0)->sum('harga_modal');
        $handphonestokhabis = Product::where('categories_id', 1)->where('stok', 0)->count();
        $handphonenominalterjual = Product::where('categories_id', 1)->where('stok', 0)->sum('harga_jual');

        $handphones_count = Product::where('categories_id', '=', '1')->count();
        return view('livewire.produk-handphone-data', [
            'toko' => $toko,
            'categories' => $categories,
            'brands' => $brands,
            'capacities' => $capacities,
            'model_series' => $model_series,
            'colors' => $colors,
            'handphones_count' => $handphones_count,
            'handphoneitemready' => $handphoneitemready,
            'handphonestokready' => $handphonestokready,
            'handphonemodalready' => $handphonemodalready,
            'handphonestokhabis' => $handphonestokhabis,
            'handphonenominalterjual' => $handphonenominalterjual,
            'products' => $this->search === null ?
                Product::latest()->where('categories_id', '=', '1')->paginate($this->paginate) :
                Product::latest()->where('categories_id', '=', '1')->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
