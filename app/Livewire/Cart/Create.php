<?php

namespace App\Livewire\Cart;

use App\Models\{Product, User};
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;

    public Product $product;

    public function render(): View
    {
        return view('livewire.cart.create');
    }

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function handleProductOrder(): void
    {
        /** @var User $user */
        $user = Auth::user();
        (new OrderService())->addProductToOrder($this->product, $user);

        $this->success('Produto adicionado ao carrinho', redirectTo: 'dashboard');
        $this->redirect(route('dashboard'));
    }
}
