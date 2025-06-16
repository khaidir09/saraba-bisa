<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceAction;

class AdminServiceActionData extends Component
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
        $service_actions_count = ServiceAction::all()->count();
        $toko = User::find(1);
        return view('livewire.admin-service-action-data', [
            'service_actions_count' => $service_actions_count,
            'toko' => $toko,
            'service_actions' => $this->search === null ?
                ServiceAction::latest()->paginate($this->paginate) :
                ServiceAction::latest()->where('nama_tindakan', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }

    public function handleStored($service_action)
    {
        session()->flash('message', 'Data tindakan servis ' . $service_action['nama_tindakan'] . ' berhasil ditambahkan');
    }
}
