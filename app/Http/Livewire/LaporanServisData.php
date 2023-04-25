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
use App\Models\User;

class LaporanServisData extends Component
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
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $jumlah = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        return view('livewire.laporan-servis-data', [
            'jumlah' => $jumlah,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'capacities' => $capacities,
            'model_series' => $model_series,
            'services' => $this->search === null ?
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')->paginate($this->paginate) :
                ServiceTransaction::latest()->where('status_servis', 'Sudah Diambil')->where('created_at', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
