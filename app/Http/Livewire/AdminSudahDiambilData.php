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

class AdminSudahDiambilData extends Component
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


    public $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatedKondisi($value, $index)
    {
        if (!$value) {
            unset($this->kondisi[$index]);
        }
    }

    public function render()
    {
        $users = User::where('role', 'Teknisi')->get();
        $toko = User::find(1);
        $workers = User::all();
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $actions = ServiceAction::all();
        $jumlahsudahdiambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
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
            'actions' => $actions,
            'service_transactions' =>
            ServiceTransaction::orderBy('tgl_ambil', 'desc')->when($this->search, function ($q) {
                $q->where('nama_pelanggan', 'like', '%' . $this->search . '%')->where('status_servis', 'Sudah Diambil')->orWhere('nomor_servis', 'like', '%' . $this->search . '%')->where('status_servis', 'Sudah Diambil')->orWhere('tindakan_servis', 'like', '%' . $this->search . '%')->where('status_servis', 'Sudah Diambil')->orWhere('nama_barang', 'like', '%' . $this->search . '%')->where('status_servis', 'Sudah Diambil');
            })->when($this->type, function ($q) {
                $q->whereIn('types_id', $this->type);
            })->when($this->kondisi, function ($q) {
                $q->whereIn('kondisi_servis', $this->kondisi)->where('status_servis', 'Sudah Diambil');
            })->paginate($this->paginate),
        ]);
    }
}
