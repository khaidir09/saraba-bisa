<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Phone;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\ModelSerie;
use Livewire\WithPagination;

class PhoneData extends Component
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
        $brands = Brand::all();
        $model_series = ModelSerie::all();
        $capacities = Capacity::all();
        $phones_count = Phone::where('stok', '1')->count();
        return view('livewire.phone-data', [
            'model_series' => $model_series,
            'brands' => $brands,
            'capacities' => $capacities,
            'phones_count' => $phones_count,
            'phones' => $this->search === null ?
                Phone::latest()->where('stok', '1')->paginate($this->paginate) :
                Phone::latest()->where('stok', '1')->where('imei', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
