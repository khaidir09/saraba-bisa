<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceAction;

class BiayaServisSearch extends Component
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
        return view('livewire.biaya-servis-search', [
            'service_actions' => $this->search === null ?
                ServiceAction::latest()->get() :
                ServiceAction::latest()->where('nama_tindakan', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
