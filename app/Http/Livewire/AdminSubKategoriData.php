<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSubKategoriData extends Component
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
        $categories = Category::all();
        $sub_categories_count = SubCategory::all()->count();
        return view('livewire.admin-sub-kategori-data', [
            'categories' => $categories,
            'sub_categories_count' => $sub_categories_count,
            'sub_categories' => $this->search === null ?
                SubCategory::latest()->paginate($this->paginate) :
                SubCategory::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
