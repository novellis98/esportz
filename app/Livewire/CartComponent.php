<?php

namespace App\Livewire;

use Livewire\Component;

class CartComponent extends Component
{
    public $cart;

    public function mount()
    {
        // Load the authenticated user's cart
        $this->cart = auth()->user()->cart;
    }
    public function removeItem($itemId)
    {
        // Rimuovi l'articolo dal carrello
        $item = $this->cart->items()->find($itemId);
        if ($item) {
            $item->delete();
        }

        // Ricarica il carrello
        $this->cart = auth()->user()->cart;
    }
    public function getCartTotal()
    {
        $total = 0;
        if ($this->cart) {
            foreach ($this->cart->items as $item) {
                $total += $item->price * $item->quantity;
            }
        }

        return $total;
    }
    public function render()
    {
        return view('livewire.cart-component', ['cart' => $this->cart, 'getCartTotal' => $this->getCartTotal()]);
    }
}
