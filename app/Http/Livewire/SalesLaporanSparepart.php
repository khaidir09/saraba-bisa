<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Phone;
use Livewire\Component;
use App\Models\Sparepart;
use Livewire\WithPagination;
use App\Models\PhoneTransaction;
use App\Models\SparepartTransaction;
use Illuminate\Support\Facades\Auth;

class SalesLaporanSparepart extends Component
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
        $spareparts = Sparepart::all();
        $jumlah = SparepartTransaction::where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->sum('quantity');
        return view('livewire.sales-laporan-sparepart', [
            'jumlah' => $jumlah,
            'spareparts' => $spareparts,
            'users' => $users,
            'sparepart_transactions' => $this->search === null ?
                SparepartTransaction::latest()->where('users_id', Auth::user()->id)->where('is_approve', 'Setuju')->paginate($this->paginate) :
                SparepartTransaction::latest()->where('users_id', Auth::user()->id)->where('is_approve', 'Setuju')->where('created_at', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
