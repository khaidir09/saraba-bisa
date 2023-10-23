<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class TeknisiPengeluaranData extends Component
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
        $expenses_count = Expense::where('users_id', Auth::user()->id)->count();
        return view('livewire.teknisi-pengeluaran-data', [
            'expenses_count' => $expenses_count,
            'expenses' => $this->search === null ?
                Expense::latest()->where('users_id', Auth::user()->id)->paginate($this->paginate) :
                Expense::latest()->where('users_id', Auth::user()->id)->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
