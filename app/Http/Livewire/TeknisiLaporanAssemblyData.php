<?php

namespace App\Http\Livewire;

use App\Models\Assembly;
use App\Models\Type;
use App\Models\User;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\Auth;

class TeknisiLaporanAssemblyData extends Component
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
        $jumlah = Assembly::where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->count();
        return view('livewire.teknisi-laporan-assembly-data', [
            'jumlah' => $jumlah,
            'users' => $users,
            'assemblies' => $this->search === null ?
                Assembly::latest()->where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->paginate($this->paginate) :
                Assembly::latest()->where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->where('created_at', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
