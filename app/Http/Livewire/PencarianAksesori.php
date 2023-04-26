<?php

namespace App\Http\Livewire;

use App\Models\Accessory;
use Livewire\Component;

class PencarianAksesori extends Component
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
        return view('livewire.pencarian-aksesori', [
            'accessories' => $this->search === null ?
                Accessory::latest()->where('stok', '>=', '1')->get() :
                Accessory::latest()->where('stok', '>=', '1')->where('name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
