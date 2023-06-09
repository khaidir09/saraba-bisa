<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sparepart;
use Livewire\Component;

class PencarianSparepart extends Component
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
        return view('livewire.pencarian-sparepart', [
            'products' => $this->search === null ?
                Product::latest()->
                // get the product that has category name sparepart
                whereHas('category', function ($query) {
                    $query->where('category_name', 'Sparepart');
                })->where('stok', '>=', '1')->get()
                :
                Product::latest()->whereHas('category', function ($query) {
                    $query->where('category_name', 'Sparepart');
                })->where('stok', '>=', '1')
                ->where('name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
