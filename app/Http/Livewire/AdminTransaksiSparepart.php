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
use App\Models\Phone;
use App\Models\PhoneTransaction;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;
use App\Models\Sparepart;
use App\Models\SparepartTransaction;

class AdminTransaksiSparepart extends Component
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
        $spareparts = Sparepart::all();
        $users = User::all();
        $sparepart_transactions_count = SparepartTransaction::where('is_admin_toko', 'Admin')
            ->count();

        return view('livewire.admin-transaksi-sparepart', [
            'spareparts' => $spareparts,
            'users' => $users,
            'sparepart_transactions_count' => $sparepart_transactions_count,
            'sparepart_transactions' => $this->search === null ?
                SparepartTransaction::latest()
                ->where('is_admin_toko', 'Admin')
                ->paginate($this->paginate) :
                SparepartTransaction::latest()
                ->where('is_admin_toko', 'Admin')
                ->where('nomor_transaksi', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }

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
