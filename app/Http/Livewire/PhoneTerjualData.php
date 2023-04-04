<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Phone;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\ModelSerie;
use Livewire\WithPagination;

class PhoneTerjualData extends Component
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
        $phones_count = Phone::where('stok', '0')->count();
        $phones_terjual_count = Phone::where('stok', '0')->count();
        return view('livewire.phone-terjual-data', [
            'model_series' => $model_series,
            'brands' => $brands,
            'capacities' => $capacities,
            'phones_count' => $phones_count,
            'phones_terjual_count' => $phones_terjual_count,
            'phones' => $this->search === null ?
                Phone::latest()->where('stok', '0')->paginate($this->paginate) :
                Phone::latest()->where('stok', '0')->where('imei', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
