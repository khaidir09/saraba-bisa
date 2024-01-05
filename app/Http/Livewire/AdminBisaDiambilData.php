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

class AdminBisaDiambilData extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;
    public $type = [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6'
    ];
    public $kondisi = [
        'Sudah jadi',
        'Tidak bisa',
        'Dibatalkan',
        'Menunggu konfirmasi'
    ];

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedKondisi($value, $index)
    {
        if (!$value) {
            unset($this->kondisi[$index]);
        }
    }

    public function render()
    {
        $customers = Customer::all();
        $toko = User::find(1);
        $users = User::where('role', 'Teknisi')->get();
        $workers = User::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $actions = ServiceAction::all();
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        return view('livewire.admin-bisa-diambil-data', [
            'users' => $users,
            'toko' => $toko,
            'workers' => $workers,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
            'actions' => $actions,
            'processes_count' => $processes_count,
            'jumlah_sudah_diambil' => $jumlah_sudah_diambil,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'bisadiambil' => $this->search === null ?
                ServiceTransaction::latest()->with('customer', 'serviceaction')
                ->where('status_servis', 'Bisa Diambil')
                ->whereIn('types_id', $this->type)
                ->whereIn('kondisi_servis', $this->kondisi)
                ->paginate($this->paginate) :
                ServiceTransaction::latest()->with('customer', 'serviceaction')
                ->where('status_servis', 'Bisa Diambil')
                ->where('nama_pelanggan', 'like', '%' . $this->search . '%')->orWhere('nomor_servis', 'like', '%' . $this->search . '%')->orWhere('tindakan_servis', 'like', '%' . $this->search . '%')->orWhere('nama_barang', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }
}
