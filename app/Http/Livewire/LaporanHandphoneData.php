<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\User;
use App\Models\Brand;
use App\Models\Phone;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use App\Models\PhoneTransaction;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;

class LaporanHandphoneData extends Component
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
        $users = User::all();
        $customers = Customer::all();
        $phones = Phone::all();
        $jumlah = PhoneTransaction::where('is_approve', 'Setuju')->count();
        return view('livewire.laporan-handphone-data', [
            'jumlah' => $jumlah,
            'phones' => $phones,
            'users' => $users,
            'customers' => $customers,
            'phone_transactions' => $this->search === null ?
                PhoneTransaction::latest()->where('is_approve', 'Setuju')->paginate($this->paginate) :
                PhoneTransaction::latest()->where('is_approve', 'Setuju')->where('nomor_transaksi', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
