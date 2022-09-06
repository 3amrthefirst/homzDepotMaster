<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart ;

class Header extends Component
{
    public $cartTotal = 0;

    protected $listeners = [
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal',
        'productDec' => 'updateCartTotal',
        'productInc' => 'updateCartTotal',
    ];

    public function mount(): void
    {
        $this->cartTotal =Cart::count();
    }

    public function render(): View
    {
        return view('livewire.header');
    }

    public function updateCartTotal(): void
    {
        $this->cartTotal = Cart::count();
    }
}
