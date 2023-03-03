<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;

class CustomerSearch extends Component
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
        return view('livewire.customer-search', [
            'customers' => $this->search === null ?
                Customer::latest()->get() :
                Customer::latest()->where('nama', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
