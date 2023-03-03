<?php

namespace App\Http\Livewire;

use App\Models\Budget;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;

class KaryawanData extends Component
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
        $workers = Worker::all();
        $budgets = Budget::all();
        $workers_count = Worker::all()->count();
        return view('livewire.karyawan-data', [
            'budgets' => $budgets,
            'workers' => $workers,
            'workers_count' => $workers_count,
            'workers' => $this->search === null ?
                Worker::latest()->paginate($this->paginate) :
                Worker::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
