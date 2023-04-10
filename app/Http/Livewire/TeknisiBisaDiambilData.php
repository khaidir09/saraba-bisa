<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\Auth;

class TeknisiBisaDiambilData extends Component
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
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->where('users_id', Auth::user()->id)->where('is_admin_toko', null)->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->where('users_id', Auth::user()->id)->where('is_admin_toko', null)->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->where('users_id', Auth::user()->id)->where('is_admin_toko', null)->count();
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->where('is_admin_toko', null)->count();
        return view('livewire.teknisi-bisa-diambil-data', [
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
            'processes_count' => $processes_count,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'jumlah_sudah_diambil' => $jumlah_sudah_diambil,
            'bisadiambil' => $this->search === null ?
                ServiceTransaction::latest()->with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->where('is_admin_toko', null)->where('users_id', Auth::user()->id)->paginate($this->paginate) :
                ServiceTransaction::latest()->with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->where('is_admin_toko', null)->where('users_id', Auth::user()->id)->where('nomor_servis', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
