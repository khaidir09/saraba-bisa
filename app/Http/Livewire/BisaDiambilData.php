<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;

class BisaDiambilData extends Component
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
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->count();
        $bisadiambil = ServiceTransaction::with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->paginate(10);
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        $jumlah_semua = ServiceTransaction::all()->count();
        return view('livewire.bisa-diambil-data', [
            'bisadiambil' => $bisadiambil,
            'processes_count' => $processes_count,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'jumlah_sudah_diambil' => $jumlah_sudah_diambil,
            'jumlah_semua' => $jumlah_semua,
            'bisadiambil' => $this->search === null ?
                ServiceTransaction::latest()->with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->paginate($this->paginate) :
                ServiceTransaction::latest()->with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->where('nomor_servis', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
