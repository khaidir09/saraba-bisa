<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SampahProdukData extends Component
{
    use WithPagination;

    public $paginate = 10;

    public function render()
    {
        $items = Product::onlyTrashed()->get();
        $items_count = $items->whereNotNull('deleted_at')->count();

        return view('livewire.sampah-produk-data', [
            'items_count' => $items_count,
            'items' => Product::onlyTrashed()->latest()->paginate($this->paginate)
        ]);
    }
}
