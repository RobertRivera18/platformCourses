<div>

    @if ($course->price->value==0)
    <button wire:click="enrolled" class="btn btn-red w-full">
        Inscribete Ahora
    </button>
    @else

    @if(Cart::instance('shopping')->content()->where('id',$course->id)->first())
    <button wire:key="removeCart" wire:click="removeCart" class="btn btn-blue w-full mb-2">
        Eliminar del Carrito
    </button>
    @else
    <button wire:key="addCart" wire:click="addCart" class="btn btn-blue w-full mb-2">
        Agregar al Carrito
    </button>
    @endif

    <button wire:click="buyNow" class="btn btn-red w-full">
        Comprar Ahora
    </button>
    @endif

</div>