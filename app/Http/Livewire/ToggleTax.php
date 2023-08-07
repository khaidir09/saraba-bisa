<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\StoreSetting;
use Livewire\WithPagination;

class ToggleTax extends Component
{
    public $taxApplied = false;

    public function mount()
    {
        $storeSettings = StoreSetting::find(1); // Ganti 1 dengan ID yang sesuai
        $this->taxApplied = $storeSettings->is_tax;
    }

    public function render()
    {
        return view('livewire.toggle-tax');
    }

    public function updatedTaxApplied()
    {
        $storeSettings = StoreSetting::find(1); // Ganti 1 dengan ID yang sesuai
        $storeSettings->update([
            'is_tax' => $this->taxApplied,
        ]);
    }
}
