<?php

namespace App\Livewire;

use App\Models\{Category, Product};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\{Computed};
use Livewire\{Component, WithPagination};
use Mary\Traits\Toast;

class Dashboard extends Component
{
    use WithPagination;
    use Toast;

    public ?string $search = null;

    public ?int $searchByCategory = null;

    public bool $hasOrder = false;

    public function render(): View
    {
        return view('livewire.dashboard');
    }

    public function mount(): void
    {
        $this->hasOrder = auth()->user()
            ->orders()
            ->where('status', 'open')
            ->exists();
    }

    /**
     * Métodos reativos são chamados automaticamente usando o padrão updated + Nome_da_propriedade
     */
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Métodos reativos são chamados automaticamente usando o padrão updated + Nome_da_propriedade
     */
    public function updatedSearchByCategory(): void
    {
        $this->resetPage();
    }

    /**
     * @return Paginator<Product>
     */
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
            ->simplePaginate(9);
    }

    /**
     * @return Collection<int, Category>
     */
    #[Computed]
    public function Categories(): Collection
    {
        return Category::get();
    }
}
