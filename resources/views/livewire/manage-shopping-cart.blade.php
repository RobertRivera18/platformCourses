<div>
    <h2 class="text-xl font-semibold mb-2">Carrito de Compras</h2>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12">
        <div class="lg:col-span-3">
            <div class="mb-2">
                <div class="card mb-2">
                    <ul class="space-y-4">
                        @forelse(Cart::instance('shopping')->content() as $item)
                        <li class="flex flex-wrap lg:flex-nowrap">
                            <figure class="shrink-0 w-full lg:w-40">
                                <img class="aspect-[16/9] w-full rounded object-cover object-center"
                                    src="{{$item->options->image}}" alt="">
                            </figure>
                            <div class="lg:flex-1 lg:ml-4 overflow-hidden">
                                <h2 class="font-semibold truncate">
                                    <a href="">
                                        {{$item->name}}
                                    </a>
                                </h2>
                                <p class="text-gray-500">
                                    {{$item->options->teacher}}
                                </p>
                                <p class="font-semibold">
                                    ${{number_format($item->price ,2)}}
                                </p>
                            </div>

                            <div class="lg:ml-6 text-sm">
                                <button wire:click="remove('{{$item->rowId}}')"
                                    class="block w-full lg:text-right font-bold text-red-600 disabled:text-red-300">
                                    Eliminar
                                </button>
                            </div>
                        </li>
                        @empty
                        <li>No hay productos en el carrito</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            @if (Cart::instance('shopping')->count())
            <button wire:click="destroy" class="font-semibold text-red-500 disabled:text-red-300 text-sm">
                <i class="fas fa-trash-alt mr-2"></i>
                Limpiar carrito de compras
            </button>
            @endif

        </div>

        <div class="lg:col-span-2">
            <div class="card">
                <h2 class="text-2xl font-semibold mb-2">Resumen</h2>
                <div class="flex justify-between items-center">
                    <p>Subtotal:</p>
                    <p>USD {{ Cart::subTotal() }}</p>
                </div>
                <hr class="my-1">
                <div class="flex justify-between items-center font-semibold mb-4">
                    <p class="text-2xl">Total</p>
                    <p class="text-lg">USD {{ Cart::SubTotal() }}</p>
                </div>

                <div x-data="{
                show: false,
                   }">

                    <label class="inline-flex text-sm mb-2">
                        <input type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 mr-2"
                            x-model="show">
                        <span>Para proceder con el pago, es necesario que primero lea y acepte los
                            <a class="text-blue-500">términos y condiciones</a>
                        </span>
                    </label>



                    @if (Cart::instance('shopping')->count())
                    <a href="{{route('checkout.index')}}" wire:loading.attr="disabled" wire:loading.class="!cursor-wait"
                        type="submit" class="outline-none inline-flex justify-center items-center group transition-all ease-in duration-150 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed rounded gap-x-2 text-sm px-4 py-2     ring-red-500 text-white bg-red-500 hover:bg-red-600 hover:ring-red-600
                    w-full" x-bind:disabled="!show" disabled="disabled">
                        Proceder con el pago
                    </a>
                    @else
                    <button disabled class="btn btn-red w-full text-center disabled:opacity-50">
                        Proceder con el pago
                    </button>
                    @endif


                </div>
                <div class="flex justify-center items-center mt-5">
                    <img class="h-8" src="{{asset('img/credit-cards.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>

</div>