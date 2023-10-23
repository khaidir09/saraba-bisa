<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class TransaksiProdukDueData extends Component
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
        $jumlah_semua = Order::all()->count();
        $jumlah_lunas = Order::where('due', '0')->count();
        $jumlah_tidaklunas = Order::where('due', '>', '0')->count();

        return view('livewire.transaksi-produk-due-data', [
            'jumlah_semua' => $jumlah_semua,
            'jumlah_lunas' => $jumlah_lunas,
            'jumlah_tidaklunas' => $jumlah_tidaklunas,
            'orders' => $this->search === null ?
                Order::latest()->where('due', '>', '0')->paginate($this->paginate) :
                Order::latest()->where('due', '>', '0')->where('invoice_no', 'like', '%' . $this->search . '%')->orWhere('nama_pelanggan', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
