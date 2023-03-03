<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;
use App\Models\User;

class SudahDiambilData extends Component
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
        $jumlahsudahdiambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        return view('livewire.sudah-diambil-data', [
            'jumlahsudahdiambil' => $jumlahsudahdiambil,
            'service_transactions' => $this->search === null ?
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')->paginate($this->paginate) :
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')->where('nomor_servis', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
