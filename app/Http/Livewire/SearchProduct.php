<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SearchProduct extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $product;

    public string $query = '';

    public $categories_id;

    public $search_results;

    public $showCount = 9;

    public $featured = false;

    protected $queryString = [
        'query'       => ['except' => ''],
        'categories_id' => ['except' => null],
        'showCount'   => ['except' => 9],
    ];

    public function loadMore()
    {
        $this->showCount = (int)$this->showCount + 5;
    }

    public function selectProduct($product)
    {
        $this->emit('productSelected', $product);
    }

    public function getCategoriesProperty()
    {
        return Category::pluck('category_name', 'id');
    }

    // in case parametre is passed to mount method, else it will be null
    public function mount()
    {
        $this->search_results = [];
    }

    public function render()
    {
        $query = Product::with('category')
            ->when($this->query, function ($query) {
                $query->where(function ($query) {
                    $query->where('product_name', 'like', '%' . $this->query . '%')->orWhere('product_code', 'like', '%' . $this->query . '%');
                });
            })
            ->when($this->categories_id, function ($query) {
                $query->where('categories_id', $this->categories_id);
            });

        $products = $query->paginate($this->showCount);

        return view('livewire.search-product', [
            'products' => $products,
        ]);
    }

    // Reset query, category, and featured
    public function resetQuery()
    {
        // Reset query, category, and featured
        $this->reset(['query', 'categories_id']);
    }

    public function updatedQuery()
    {
        if (!empty($this->search_results)) {
            $this->product = $this->search_results[0];
            $this->emit('productSelected', $this->product);
        }
    }
}
