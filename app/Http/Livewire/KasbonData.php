<?php

namespace App\Http\Livewire;

use App\Models\Debt;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;

class KasbonData extends Component
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
        $debts_count = Debt::all()->count();
        return view('livewire.kasbon-data', [
            'workers' => $workers,
            'debts_count' => $debts_count,
            'debts' => $this->search === null ?
                Debt::orderByRaw('is_approve IS NULL DESC')->latest()->paginate($this->paginate) :
                Debt::orderByRaw('is_approve IS NULL DESC')->latest()->where('item', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
