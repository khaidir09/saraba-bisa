<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceTransaction;

class ServisBelumDisetujuiData extends Component
{
    use WithPagination;

    public $paginate = 50;
    public $search;
    public $type = [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6'
    ];
    public $kondisi = [
        'Sudah jadi',
        'Tidak bisa',
        'Dibatalkan',
        'Menunggu konfirmasi'
    ];

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedKondisi($value, $index)
    {
        if (!$value) {
            unset($this->kondisi[$index]);
        }
    }

    public function render()
    {
        $toko = User::find(1);
        $types = Type::all();
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        $jumlah_belum_disetujui = ServiceTransaction::where('status_servis', 'Sudah Diambil')->where('is_approve', '=', null)->count();
        return view('livewire.servis-belum-disetujui-data', [
            'toko' => $toko,
            'types' => $types,
            'processes_count' => $processes_count,
            'jumlah_bisa_diambil' => $jumlah_bisa_diambil,
            'jumlah_sudah_diambil' => $jumlah_sudah_diambil,
            'jumlah_belum_disetujui' => $jumlah_belum_disetujui,
            'service_transactions' => $this->search === null ?
                ServiceTransaction::orderBy('tgl_ambil', 'desc')->where('status_servis', 'Sudah Diambil')->where('is_approve', null)->whereIn('types_id', $this->type)->whereIn('kondisi_servis', $this->kondisi)->paginate($this->paginate) :
                ServiceTransaction::orderBy('tgl_ambil', 'desc')->where('status_servis', 'Sudah Diambil')->where('is_approve', null)->where('nama_pelanggan', 'like', '%' . $this->search . '%')->orWhere('nomor_servis', $this->search)->paginate($this->paginate)
        ]);
    }
}
