<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SampahPelangganData extends Component
{
    use WithPagination;

    public $search;

    public $queryString = [
        'search' => ['except' => ''],
    ];

    public $paginate = 10;

    public function render()
    {
        $items = Customer::onlyTrashed()->get();
        $items_count = $items->whereNotNull('deleted_at')->count();

        return view('livewire.sampah-pelanggan-data', [
            'items_count' => $items_count,
            'items' => Customer::onlyTrashed()->latest()->when($this->search, function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')->onlyTrashed()->orWhere('nomor_hp', 'like', '%' . $this->search . '%')->onlyTrashed();
            })->paginate($this->paginate),
        ]);
    }
}
