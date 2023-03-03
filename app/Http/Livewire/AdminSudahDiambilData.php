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
        $workers = Worker::where('jabatan', 'like', '%' . 'teknisi')->get();
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $jumlahsudahdiambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->where('is_admin_toko', 'Admin')
            ->count();
        return view('livewire.admin-sudah-diambil-data', [
            'jumlahsudahdiambil' => $jumlahsudahdiambil,
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
                ->paginate($this->paginate) :
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')
                ->where('is_admin_toko', 'Admin')
                ->where('nomor_servis', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }
}
