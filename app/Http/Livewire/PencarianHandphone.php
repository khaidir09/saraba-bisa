<?php

namespace App\Http\Livewire;

use App\Models\Phone;
use Livewire\Component;

class PencarianHandphone extends Component
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
        return view('livewire.pencarian-handphone', [
            'phones' => $this->search === null ?
                Phone::latest()->where('stok', 1)->get() :
                Phone::with('modelserie')->latest()->where('stok', 1)->where('modelserie->name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
