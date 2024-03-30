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

class SudahDiambilData extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;
    public $type;

    public function mount()
    {
        $this->type = Type::pluck('id')->toArray();
    }

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

        return view('livewire.sudah-diambil-data', [
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
            'service_transactions' => ServiceTransaction::orderBy('tgl_ambil', 'desc')->when($this->search, function ($q) {
                $q->where('nama_pelanggan', 'like', '%' . $this->search . '%')->where('status_servis', 'Sudah Diambil')->orWhere('nomor_servis', 'like', '%' . $this->search . '%')->where('status_servis', 'Sudah Diambil')->orWhere('tindakan_servis', 'like', '%' . $this->search . '%')->where('status_servis', 'Sudah Diambil')->orWhere('nama_barang', 'like', '%' . $this->search . '%')->where('status_servis', 'Sudah Diambil');
            })->when($this->type, function ($q) {
                $q->whereIn('types_id', $this->type);
            })->when($this->kondisi, function ($q) {
                $q->whereIn('kondisi_servis', $this->kondisi)->where('status_servis', 'Sudah Diambil');
            })->paginate($this->paginate),
        ]);
    }
}
