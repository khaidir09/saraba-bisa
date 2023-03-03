<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Accessory;

class AdminAksesorisData extends Component
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
        $accessories_count = Accessory::all()->count();
        return view('livewire.admin-aksesoris-data', [
            'accessories_count' => $accessories_count,
            'accessories' => $this->search === null ?
                Accessory::latest()->paginate($this->paginate) :
                Accessory::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
