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
        $users = User::where('role', 'Teknisi')->get();
        $workers = Worker::where('jabatan', 'like', '%' . 'teknisi')->get();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')
            ->where('is_admin_toko', 'Admin')
            ->count();
        return view('livewire.admin-bisa-diambil-data', [
            'users' => $users,
            'workers' => $workers,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'bisadiambil' => $this->search === null ?
                ServiceTransaction::latest()->with('customer', 'serviceaction')
                ->where('status_servis', 'Bisa Diambil')
                ->where('is_admin_toko', 'Admin')
                ->paginate($this->paginate) :
                ServiceTransaction::latest()->with('customer', 'serviceaction')
                ->where('status_servis', 'Bisa Diambil')
                ->where('is_admin_toko', 'Admin')
                ->where('nomor_servis', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }
}
