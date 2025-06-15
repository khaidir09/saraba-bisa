<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StoreSetting;

class ToggleBonus extends Component
{
    public $bonusApplied = false;

    public function mount()
    {
        $storeSettings = StoreSetting::find(1); // Ganti 1 dengan ID yang sesuai
        $this->bonusApplied = $storeSettings->is_bonus;
    }

    public function render()
    {
        return view('livewire.toggle-bonus');
    }

    public function updatedBonusApplied()
    {
        $storeSettings = StoreSetting::find(1); // Ganti 1 dengan ID yang sesuai
        $storeSettings->update([
            'is_bonus' => $this->bonusApplied,
        ]);
    }
}
