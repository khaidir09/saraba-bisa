<?php

namespace App\Http\Livewire;

use App\Models\Debt;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TeknisiKasbonData extends Component
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
        $debts_count = Debt::where('workers_id', Auth::user()->worker->id)->count();
        return view('livewire.teknisi-kasbon-data', [
            'debts_count' => $debts_count,
            'debts' => $this->search === null ?
                Debt::latest()->where('workers_id', Auth::user()->worker->id)->paginate($this->paginate) :
                Debt::latest()->where('workers_id', Auth::user()->worker->id)->where('item', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
