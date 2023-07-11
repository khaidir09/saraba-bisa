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

class LaporanServisData extends Component
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
        $jumlah = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        return view('livewire.laporan-servis-data', [
            'jumlah' => $jumlah,
            'services' => $this->search === null ?
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')->where('kondisi_servis', 'Sudah jadi')->paginate($this->paginate) :
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')->where('kondisi_servis', 'Sudah jadi')->where('created_at', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
