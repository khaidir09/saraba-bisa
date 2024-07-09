<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\ModelSerie;
use App\Models\SubCategory;
use App\Models\StoreSetting;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ProdukAksesorisData extends Component
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
        $aksesorisitemready = Product::where('categories_id', 3)->where('stok', '>', 0)->count();
        $aksesorisstokready = Product::where('categories_id', 3)->where('stok', '>', 0)->sum('stok');
        $aksesorismodalready = Product::where('categories_id', 3)->where('stok', '>', 0)->sum('harga_modal');
        $aksesorisstokhabis = Product::where('categories_id', 3)->where('stok', 0)->count();
        $aksesorisnominalterjual = Product::where('categories_id', 3)->where('stok', 0)->sum('harga_jual');
        return view('livewire.produk-aksesoris-data', [
            'toko' => $toko,
            'accessories' => $accessories,
            'model_series' => $model_series,
            'accessories_count' => $accessories_count,
            'aksesorisitemready' => $aksesorisitemready,
            'aksesorisstokready' => $aksesorisstokready,
            'aksesorismodalready' => $aksesorismodalready,
            'aksesorisstokhabis' => $aksesorisstokhabis,
            'aksesorisnominalterjual' => $aksesorisnominalterjual,
            'products' => $this->search === null ?
                Product::latest()->where('categories_id', '=', '3')->paginate($this->paginate) :
                Product::latest()->where('categories_id', '=', '3')->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
