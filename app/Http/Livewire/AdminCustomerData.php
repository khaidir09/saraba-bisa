<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use App\Exports\PelangganExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminCustomerData extends Component
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

    protected $listeners = [
        'customerStored' => 'handleStored'
    ];

    public function render()
    {
        $customers_count = Customer::all()->count();
        return view('livewire.admin-customer-data', [
            'customers_count' => $customers_count,
            'customers' => $this->search === null ?
                Customer::latest()->paginate($this->paginate) :
                Customer::latest()->where('nama', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }

    public function export()
    {
        return Excel::download(new PelangganExport, 'data-pelanggan.xlsx');
    }

    public function handleStored($customer)
    {
        session()->flash('message', 'Data pelanggan ' . $customer['nama'] . ' berhasil ditambahkan');
    }
}
