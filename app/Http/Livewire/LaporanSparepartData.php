<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Sparepart;
use App\Models\SparepartTransaction;
use Livewire\WithPagination;

class LaporanSparepartData extends Component
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
        $customers = Customer::all();
        $spareparts = Sparepart::all();
        $jumlah = SparepartTransaction::where('is_approve', 'Setuju')->sum('quantity');
        return view('livewire.laporan-sparepart-data', [
            'jumlah' => $jumlah,
            'spareparts' => $spareparts,
            'users' => $users,
            'customers' => $customers,
            'sparepart_transactions' => $this->search === null ?
                SparepartTransaction::latest()->where('is_approve', 'Setuju')->paginate($this->paginate) :
                SparepartTransaction::latest()->where('is_approve', 'Setuju')->where('nomor_transaksi', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
