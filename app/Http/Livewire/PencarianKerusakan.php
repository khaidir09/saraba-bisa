<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceAction;

class PencarianKerusakan extends Component
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
        return view('livewire.pencarian-kerusakan', [
            'service_actions' => $this->search === null ?
                ServiceAction::latest()->get() :
                ServiceAction::latest()->where('nama_tindakan', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
