<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Phone;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PhoneTransaction;
use Illuminate\Support\Facades\Auth;

class SalesLaporanHandphone extends Component
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
        $phones = Phone::all();
        $jumlah = PhoneTransaction::where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->count();
        return view('livewire.sales-laporan-handphone', [
            'jumlah' => $jumlah,
            'phones' => $phones,
            'users' => $users,
            'phone_transactions' => $this->search === null ?
                PhoneTransaction::latest()->where('users_id', Auth::user()->id)->where('is_approve', 'Setuju')->paginate($this->paginate) :
                PhoneTransaction::latest()->where('users_id', Auth::user()->id)->where('is_approve', 'Setuju')->where('created_at', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
