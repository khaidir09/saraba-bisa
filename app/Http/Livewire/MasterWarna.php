<?php

namespace App\Http\Livewire;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Type;

class MasterWarna extends Component
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
        $count = Color::all()->count();
        return view('livewire.master-warna', [
            'count' => $count,
            'colors' => $this->search === null ?
                Color::latest()->paginate($this->paginate) :
                Color::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
