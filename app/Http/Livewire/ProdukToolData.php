<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\ModelSerie;
use App\Models\SubCategory;
use App\Models\StoreSetting;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ProdukToolData extends Component
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
        $tools = SubCategory::where('categories_id', '=', '4')->get();
        $toko = StoreSetting::find(1);
        $tools_count = Product::where('categories_id', '=', '4')->count();
        $toolitemready = Product::where('categories_id', 4)->where('stok', '>', 0)->count();
        $toolstokready = Product::where('categories_id', 4)->where('stok', '>', 0)->sum('stok');
        $toolmodalready = Product::where('categories_id', 4)->where('stok', '>', 0)->sum(DB::raw('stok * harga_modal'));
        $toolstokhabis = Product::where('categories_id', 4)->where('stok', 0)->count();
        $toolnominalterjual = Product::where('categories_id', 4)->where('stok', 0)->sum('harga_jual');
        return view('livewire.produk-tool-data', [
            'toko' => $toko,
            'tools' => $tools,
            'tools_count' => $tools_count,
            'toolitemready' => $toolitemready,
            'toolstokready' => $toolstokready,
            'toolmodalready' => $toolmodalready,
            'toolstokhabis' => $toolstokhabis,
            'toolnominalterjual' => $toolnominalterjual,
            'products' => $this->search === null ?
                Product::latest()->where('categories_id', '=', '4')->paginate($this->paginate) :
                Product::latest()->where('categories_id', '=', '4')->where('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
