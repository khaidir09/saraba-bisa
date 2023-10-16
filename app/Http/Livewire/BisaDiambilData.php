<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\User;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use Livewire\WithPagination;
use App\Models\ServiceAction;
use App\Models\ServiceTransaction;

class BisaDiambilData extends Component
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
        $toko = User::find(1);
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $users = User::where('role', 'Teknisi')->get();
        $workers = User::all();
        $actions = ServiceAction::all();

        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        $jumlah_belum_disetujui = ServiceTransaction::where('status_servis', 'Sudah Diambil')->where('is_approve', '=', null)->count();

        return view('livewire.bisa-diambil-data', [
            'toko' => $toko,
            'users' => $users,
            'workers' => $workers,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
            'actions' => $actions,
            'processes_count' => $processes_count,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'jumlah_sudah_diambil' => $jumlah_sudah_diambil,
            'jumlah_belum_disetujui' => $jumlah_belum_disetujui,
            'bisadiambil' => $this->search === null ?
                ServiceTransaction::latest()->with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->where('types_id', 'like', '%' . $this->type . '%')->paginate($this->paginate) :
                ServiceTransaction::latest()->with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->where('nama_pelanggan', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
