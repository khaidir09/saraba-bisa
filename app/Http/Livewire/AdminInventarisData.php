<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminInventarisData extends Component
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

    public function render()
    {
        $inventories_count = Inventory::all()->count();
        return view('livewire.admin-inventaris-data', [
            'inventories_count' => $inventories_count,
            'inventories' => $this->search === null ?
                Inventory::latest()->paginate($this->paginate) :
                Inventory::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
