<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Assembly;
use App\Models\Capacity;
use Livewire\WithPagination;

class AdminAssemblyData extends Component
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
        $users = User::where('role', 'Teknisi')->get();
        $capacities = Capacity::all();
        $assemblies_count = Assembly::all()->count();
        return view('livewire.admin-assembly-data', [
            'users' => $users,
            'capacities' => $capacities,
            'assemblies_count' => $assemblies_count,
            'assemblies' => $this->search === null ?
                Assembly::latest()->paginate($this->paginate) :
                Assembly::latest()->where('imei', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
