<?php

namespace App\Http\Livewire;

use App\Models\Sparepart;
use Livewire\Component;

class PencarianSparepart extends Component
{

    public $search;

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pencarian-sparepart', [
            'spareparts' => $this->search === null ?
                Sparepart::latest()->where('stok', '>=', '1')->get() :
                Sparepart::latest()->where('stok', '>=', '1')->where('name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
