<?php

namespace App\Livewire;

use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ManageShoppingCart extends Component
{

    public function remove($rowId)
    {
        Cart::instance('shopping');
        Cart::remove($rowId);
        $this->dispatch('cart-updated', Cart::count());
    }
    public function destroy()
    {
        Cart::instance('shopping');
        Cart::destroy();
        

    }



    public function render()
    {
        return view('livewire.manage-shopping-cart');
    }
}
