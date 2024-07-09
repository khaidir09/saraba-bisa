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

class ProdukSparepartData extends Component
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
        $spareparts = SubCategory::where('categories_id', '=', '2')->get();
        $model_series = ModelSerie::all();
        $toko = StoreSetting::find(1);
        $spareparts_count = Product::where('categories_id', '=', '2')->count();
        $sparepartitemready = Product::where('categories_id', 2)->where('stok', '>', 0)->count();
        $sparepartstokready = Product::where('categories_id', 2)->where('stok', '>', 0)->sum('stok');
        $sparepartmodalready = Product::where('categories_id', 2)->where('stok', '>', 0)->sum('harga_modal');
        $sparepartstokhabis = Product::where('categories_id', 2)->where('stok', 0)->count();
        $sparepartnominalterjual = Product::where('categories_id', 2)->where('stok', 0)->sum('harga_jual');
        return view('livewire.produk-sparepart-data', [
            'toko' => $toko,
            'spareparts' => $spareparts,
            'model_series' => $model_series,
            'spareparts_count' => $spareparts_count,
            'sparepartitemready' => $sparepartitemready,
            'sparepartstokready' => $sparepartstokready,
            'sparepartmodalready' => $sparepartmodalready,
            'sparepartstokhabis' => $sparepartstokhabis,
            'sparepartnominalterjual' => $sparepartnominalterjual,
            'products' => $this->search === null ?
                Product::latest()->where('categories_id', '=', '2')->paginate($this->paginate) :
                Product::latest()->where('categories_id', '=', '2')->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
