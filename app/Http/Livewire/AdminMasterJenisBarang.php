<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Type;

class AdminMasterJenisBarang extends Component
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
        $types_count = Type::all()->count();
        return view('livewire.admin-master-jenis-barang', [
            'types_count' => $types_count,
            'types' => $this->search === null ?
                Type::latest()->paginate($this->paginate) :
                Type::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
