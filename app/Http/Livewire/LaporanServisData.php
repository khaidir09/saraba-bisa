<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;
use App\Models\User;

class LaporanServisData extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;
    public $user;

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
        $users = User::where('role', 'Teknisi')->get();
        $jumlah = ServiceTransaction::where('is_approve', 'Setuju')->where('kondisi_servis', "Sudah jadi")->count();
        return view('livewire.laporan-servis-data', [
            'jumlah' => $jumlah,
            'users' => $users,
            'services' => $this->search === null ?
                ServiceTransaction::orderBy('tgl_disetujui', 'desc')->where('is_approve', 'Setuju')->where('kondisi_servis', "Sudah jadi")->where('users_id', 'like', '%' . $this->user . '%')->paginate($this->paginate) :
                ServiceTransaction::orderBy('tgl_disetujui', 'desc')->where('is_approve', 'Setuju')->where('kondisi_servis', "Sudah jadi")->where('created_at', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
