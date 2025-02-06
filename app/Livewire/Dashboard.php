<?php

namespace App\Livewire;

use App\Models\{Category, Product};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\{Builder};
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\{Component, WithPagination};

class Dashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public ?string $search = null;

    public ?int $searchByCategory = null;

    public function render(): View
    {
        return view('livewire.dashboard');
    }

    #[Computed]
    public function Products(): Paginator
    {
        return Product::query()
            ->when(
                $this->search,
                fn (Builder $q) => $q->where(
                    'title',
                    'like',
                    '%' . $this->search . '%'
                )
            )
            ->when(
                $this->searchByCategory,
                fn (Builder $q) => $q->where(
                    'category_id',
                    '=',
                    $this->searchByCategory
                )
            )
            ->limit(6)
            ->simplePaginate(9);
    }

    #[Computed]
    public function Categories()
    {
        return Category::get();
    }
}
