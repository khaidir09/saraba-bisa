<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\User;
use App\Models\Brand;
use App\Models\Worker;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;

class AdminSudahDiambilData extends Component
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
        $toko = User::find(1);
        $workers = Worker::where('jabatan', 'like', '%' . 'teknisi')->get();
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        return view('livewire.admin-sudah-diambil-data', [
            'processes_count' => $processes_count,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'jumlah_sudah_diambil' => $jumlah_sudah_diambil,
            'toko' => $toko,
            'users' => $users,
            'workers' => $workers,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'capacities' => $capacities,
            'model_series' => $model_series,
            'service_transactions' => $this->search === null ?
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')
                ->paginate($this->paginate) :
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')
                ->where('nomor_servis', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }
}
