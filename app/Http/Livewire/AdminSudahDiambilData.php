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
    public $type;

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
        $jumlahsudahdiambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->where('is_admin_toko', 'Admin')
            ->count();
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])
            ->where('is_admin_toko', 'Admin')
            ->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->where('is_admin_toko', 'Admin')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->where('is_admin_toko', 'Admin')->count();
        return view('livewire.admin-sudah-diambil-data', [
            'processes_count' => $processes_count,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'jumlah_sudah_diambil' => $jumlah_sudah_diambil,
            'jumlahsudahdiambil' => $jumlahsudahdiambil,
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
                ->where('is_admin_toko', 'Admin')
                ->where('types_id', 'like', '%' . $this->type . '%')
                ->paginate($this->paginate) :
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')
                ->where('is_admin_toko', 'Admin')
                ->where('nama_pelanggan', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }
}
