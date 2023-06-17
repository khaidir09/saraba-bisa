<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminKategoriData extends Component
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
        $categories_count = Category::all()->count();
        return view('livewire.admin-kategori-data', [
            'categories_count' => $categories_count,
            'categories' => $this->search === null ?
                Category::latest()->paginate($this->paginate) :
                Category::latest()->where('category_name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
