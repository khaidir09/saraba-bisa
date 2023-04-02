<?php

namespace App\Http\Livewire;

use App\Models\ModelSerie;
use Livewire\Component;

class PencarianModelSeri extends Component
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
        return view('livewire.pencarian-model-seri', [
            'model_series' => $this->search === null ?
                ModelSerie::latest()->get() :
                ModelSerie::latest()->where('name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
