<?php

namespace App\Http\Livewire;

use App\Models\ServiceTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class SampahServisData extends Component
{
    use WithPagination;

    public $paginate = 10;

    public function render()
    {
        $sampahServis = ServiceTransaction::onlyTrashed()->get();
        $services_count = $sampahServis->whereNotNull('deleted_at')->count();

        return view('livewire.sampah-servis-data', [
            'services_count' => $services_count,
            'services' => ServiceTransaction::onlyTrashed()->latest()->paginate($this->paginate)
        ]);
    }
}
