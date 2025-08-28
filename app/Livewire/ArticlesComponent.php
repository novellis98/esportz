<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use App\Models\ClothingCategory;
use App\Models\PersonCategory;
use Livewire\Component;

class ArticlesComponent extends Component
{
    public $categories;
    public $clothingCategories;
    public $personCategories;
    public $category = '';
    public $clothingCategory = '';
    public $personCategory = '';
    public $min_price = '';
    public $max_price = '';
    public $articles;
    public $search = '';
    public $sortBy = '';
    public $customRoute = 'articles.show';

    public function mount()
    {
        $this->categories = Category::all();
        $this->clothingCategories = ClothingCategory::all();
        $this->personCategories = PersonCategory::all();
        $this->articles = Article::all();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'search') {
            $this->searchArticles();
        } else {
            $this->filterArticles();
        }
    }
    public function searchArticles()
    {
        $query = Article::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        $this->articles = $query->get();
    }
    public function filterArticles()
    {
        $query = Article::query();

        if (!empty($this->category)) {
            $query->where('category_id', $this->category);
        }

        if (!empty($this->clothingCategory)) {
            $query->where('clothing_category_id', $this->clothingCategory);
        }

        if (!empty($this->personCategory)) {
            $query->where('person_category_id', $this->personCategory);
        }

        if (!empty($this->min_price)) {
            $query->where('price', '>=', $this->min_price);
        }

        if (!empty($this->max_price)) {
            $query->where('price', '<=', $this->max_price);
        }
        // **Ordinamento**
        if ($this->sortBy === 'latest') {
            $query->orderBy('created_at', 'desc'); // Articoli più recenti
        } elseif ($this->sortBy === 'price_asc') {
            $query->orderBy('price', 'asc'); // Prezzo crescente
        } elseif ($this->sortBy === 'price_desc') {
            $query->orderBy('price', 'desc'); // Prezzo decrescente
        }

        $this->articles = $query->get();
    }

    public function render()
    {
        return view('livewire.articles-component', [
            'articles' => $this->articles,
        ]);
    }
    public function resetFilters()
    {
        $this->reset(['search', 'category', 'clothingCategory', 'personCategory', 'min_price', 'max_price', 'sortBy']);
        $this->filterArticles(); // Ricarica gli articoli senza filtri
    }
}
