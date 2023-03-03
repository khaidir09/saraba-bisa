<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sparepart;

class SparepartData extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'customerStored' => 'handleStored'
    ];

    public function render()
    {
        $spareparts_count = Sparepart::all()->count();
        return view('livewire.sparepart-data', [
            'spareparts_count' => $spareparts_count,
            'spareparts' => $this->search === null ?
                Sparepart::latest()->paginate($this->paginate) :
                Sparepart::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
