<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Assembly;
use App\Models\Capacity;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class TeknisiAssemblyData extends Component
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
        $capacities = Capacity::all();
        $assemblies_count = Assembly::where('users_id', Auth::user()->id)->count();
        return view('livewire.teknisi-assembly-data', [
            'capacities' => $capacities,
            'assemblies_count' => $assemblies_count,
            'assemblies' => $this->search === null ?
                Assembly::latest()->where('users_id', Auth::user()->id)->paginate($this->paginate) :
                Assembly::latest()->where('imei', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
