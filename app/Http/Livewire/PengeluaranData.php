<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class PengeluaranData extends Component
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
        $expenses_count = Expense::all()->count();
        return view('livewire.pengeluaran-data', [
            'expenses_count' => $expenses_count,
            'expenses' => $this->search === null ?
                Expense::latest()->paginate($this->paginate) :
                Expense::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
