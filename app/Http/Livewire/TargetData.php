<?php

namespace App\Http\Livewire;

use App\Models\Target;
use Livewire\Component;
use Livewire\WithPagination;

class TargetData extends Component
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
        $targets_count = Target::all()->count();
        return view('livewire.target-data', [
            'targets_count' => $targets_count,
            'targets' => $this->search === null ?
                Target::latest()->paginate($this->paginate) :
                Target::latest()->where('created_at', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
