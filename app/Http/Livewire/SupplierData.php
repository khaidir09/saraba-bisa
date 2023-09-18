<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierData extends Component
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
        $suppliers_count = Supplier::all()->count();
        return view('livewire.supplier-data', [
            'suppliers_count' => $suppliers_count,
            'suppliers' => $this->search === null ?
                Supplier::latest()->paginate($this->paginate) :
                Supplier::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
