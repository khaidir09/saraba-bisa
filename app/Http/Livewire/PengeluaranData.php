<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use App\Models\User;
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
        $users = User::all();
        $expenses_count = Expense::all()->count();
        return view('livewire.pengeluaran-data', [
            'users' => $users,
            'expenses_count' => $expenses_count,
            'expenses' => $this->search === null ?
                Expense::orderByRaw('is_approve IS NULL DESC')->latest()->paginate($this->paginate) :
                Expense::orderByRaw('is_approve IS NULL DESC')->latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
