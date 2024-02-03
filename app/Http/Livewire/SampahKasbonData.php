<?php

namespace App\Http\Livewire;

use App\Models\Debt;
use App\Models\Incident;
use Livewire\Component;
use Livewire\WithPagination;

class SampahKasbonData extends Component
{
    use WithPagination;

    public $paginate = 10;

    public function render()
    {
        $items = Debt::onlyTrashed()->get();
        $items_count = $items->whereNotNull('deleted_at')->count();

        return view('livewire.sampah-kasbon-data', [
            'items_count' => $items_count,
            'items' => Debt::onlyTrashed()->latest()->paginate($this->paginate)
        ]);
    }
}
