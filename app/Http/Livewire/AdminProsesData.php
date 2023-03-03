<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\User;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Customer;
use Barryvdh\DomPDF\PDF;
use App\Models\ModelSerie;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;
use App\Models\Worker;
use Doctrine\Inflector\Rules\Word;

class AdminProsesData extends Component
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
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->where('is_admin_toko', 'Admin')->count();
        $users = User::where('role', 'Teknisi')->get();
        $workers = Worker::where('jabatan', 'like', '%' . 'teknisi')->get();
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        return view('livewire.admin-proses-data', [
            'processes_count' => $processes_count,
            'users' => $users,
            'workers' => $workers,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
            'processes' => $this->search === null ?
                ServiceTransaction::latest()->whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->where('is_admin_toko', 'Admin')->paginate($this->paginate) :
                ServiceTransaction::latest()->whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->where('is_admin_toko', 'Admin')->where('nomor_servis', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }

    // public function getProses($id)
    // {
    //     $service_transaction = ServiceTransaction::find($id);
    //     $this->emit('getProses', $service_transaction);
    // }

    public function cetak($id)
    {
        $items = ServiceTransaction::findOrFail($id);
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $users = User::find(1);

        $pdf = PDF::loadView('pages.kepalatoko.cetak', [
            'users' => $users,
            'items' => $items,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function cetaktermal($id)
    {
        $items = ServiceTransaction::findOrFail($id);
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $users = User::find(1);

        $pdf = PDF::loadView('pages.kepalatoko.cetak-termal', [
            'users' => $users,
            'items' => $items,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities
        ])->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
