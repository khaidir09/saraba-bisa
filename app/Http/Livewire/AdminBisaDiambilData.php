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
use App\Models\StoreSetting;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;

class AdminBisaDiambilData extends Component
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
        $customers = Customer::all();
        $toko = User::find(1);
        $users = User::where('role', 'Teknisi')->get();
        $workers = Worker::where('jabatan', 'like', '%' . 'teknisi')->get();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])
            ->where('is_admin_toko', 'Admin')
            ->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->where('is_admin_toko', 'Admin')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->where('is_admin_toko', 'Admin')->count();
        $pajaktoko = StoreSetting::find(1);
        return view('livewire.admin-bisa-diambil-data', [
            'users' => $users,
            'toko' => $toko,
            'pajaktoko' => $pajaktoko,
            'workers' => $workers,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
            'processes_count' => $processes_count,
            'jumlah_sudah_diambil' => $jumlah_sudah_diambil,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'bisadiambil' => $this->search === null ?
                ServiceTransaction::latest()->with('customer', 'serviceaction')
                ->where('status_servis', 'Bisa Diambil')
                ->where('is_admin_toko', 'Admin')
                ->paginate($this->paginate) :
                ServiceTransaction::latest()->with('customer', 'serviceaction')
                ->where('status_servis', 'Bisa Diambil')
                ->where('is_admin_toko', 'Admin')
                ->where('nama_pelanggan', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }
}
