<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;
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
        return view('livewire.admin-pos-data', [
            'sales' => $sales,
            'products_count' => $products_count,
            'products' => $this->search === null ?
                Product::latest()->where('stok', '>=', '1')->simplePaginate($this->paginate) :
                Product::latest()->where('stok', '>=', '1')->where('product_name', 'like', '%' . $this->search . '%')->simplePaginate($this->paginate)
        ]);
    }
}
