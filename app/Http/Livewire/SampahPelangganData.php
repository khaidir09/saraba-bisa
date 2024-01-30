<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SampahPelangganData extends Component
{
    use WithPagination;

    public $paginate = 10;

    public function render()
    {
        $items = Customer::onlyTrashed()->get();
        $items_count = $items->whereNotNull('deleted_at')->count();

        return view('livewire.sampah-pelanggan-data', [
            'items_count' => $items_count,
            'items' => Customer::onlyTrashed()->latest()->paginate($this->paginate)
        ]);
    }
}
