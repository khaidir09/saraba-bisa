<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use App\Models\StoreSetting;
use Livewire\WithPagination;

class AdminPosData extends Component
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
        $sales = User::where('role', 'Sales')->get();
        $products_count = Product::all()->count();
        $toko = StoreSetting::find(1);
        return view('livewire.admin-pos-data', [
            'toko' => $toko,
            'sales' => $sales,
            'products_count' => $products_count,
            'products' => $this->search === null ?
                Product::latest()->where('stok', '>=', '1')->simplePaginate($this->paginate) :
                Product::latest()->where('stok', '>=', '1')->where('product_name', 'like', '%' . $this->search . '%')->simplePaginate($this->paginate)
        ]);
    }
}
