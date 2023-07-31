<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class PencarianProduk extends Component
{

    public $search;

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pencarian-produk', [
            'products' => $this->search === null ?
                Product::latest()->get() :
                Product::latest()->where('product_name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
