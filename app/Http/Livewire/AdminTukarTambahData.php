<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Capacity;
use App\Models\Color;
use App\Models\User;
use App\Models\Retur;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\ModelSerie;
use App\Models\Purchase;
use Livewire\WithPagination;

class AdminTukarTambahData extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;

    public $payment_method;

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
        $purchases_count = Purchase::whereNull('keterangan')
            ->orWhere('keterangan', '!=', 'Tukar Tambah')->count();
        $returs_count = Retur::all()->count();
        $trade_ins_count = Purchase::where('keterangan', '=', 'Tukar Tambah')->count();
        $products = Product::where('categories_id', '1')->get();
        $customers = Customer::all();
        $sales = User::where('role', 'Sales')->get();
        $brands = Brand::all();
        $model_series = ModelSerie::all();
        $capacities = Capacity::all();
        $colors = Color::all();
        return view('livewire.admin-tukar-tambah-data', [
            'purchases_count' => $purchases_count,
            'returs_count' => $returs_count,
            'trade_ins_count' => $trade_ins_count,
            'products' => $products,
            'customers' => $customers,
            'sales' => $sales,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
            'colors' => $colors,
            'tradeins' => $this->search === null ?
                Purchase::latest()->where('keterangan', 'Tukar Tambah')->paginate($this->paginate) :
                Purchase::latest()->where('keterangan', 'Tukar Tambah')->where('reference_number', 'like', '%' . $this->search . '%')->orWhere('product_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
