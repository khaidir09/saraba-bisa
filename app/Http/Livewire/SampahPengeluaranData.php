<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class SampahPengeluaranData extends Component
{
    use WithPagination;

    public $paginate = 10;

    public function render()
    {
        $items = Expense::onlyTrashed()->get();
        $items_count = $items->whereNotNull('deleted_at')->count();

        return view('livewire.sampah-pengeluaran-data', [
            'items_count' => $items_count,
            'items' => Expense::onlyTrashed()->latest()->paginate($this->paginate)
        ]);
    }
}
