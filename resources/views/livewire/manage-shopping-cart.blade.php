<div class="p-6 lg:p-12 bg-gray-100 rounded-lg shadow-lg">
    <h2 class="text-3xl font-extrabold mb-8 text-gray-800">Carrito de Compras</h2>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        <!-- Lista de productos -->
        <div class="lg:col-span-3 space-y-6">
            @forelse(Cart::instance('shopping')->content() as $item)
            <div class="flex items-center gap-6 p-4 bg-white rounded-lg shadow-md border border-gray-200">
                <!-- Imagen -->
                <figure class="w-24 h-24 flex-shrink-0">
                    <img class="w-full h-full rounded-lg object-cover" src="{{$item->options->image}}"
                        alt="{{$item->name}}">
                </figure>

                <!-- Detalles del producto -->
                <div class="flex-1">
                    <h3 class="text-lg font-semibold truncate text-gray-800">
                        <a href="#" class="hover:text-indigo-600">{{$item->name}}</a>
                    </h3>
                    <p class="text-sm text-gray-500">{{$item->options->teacher}}</p>
                    <p class="font-bold text-gray-800 mt-1">${{number_format($item->price, 2)}}</p>
                </div>

                <!-- Botón de eliminar -->
                <button wire:click="remove('{{$item->rowId}}')"
                    class="text-red-600 font-medium hover:text-red-800 transition">
                    Eliminar
                </button>
            </div>
            @empty
            <div class="text-center py-8">
            
                <svg class="h-24 w-24 text-gray-400 mb-6 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <p class="text-3xl font-extrabold text-gray-800 mb-3">
                    ¡Tu carrito está vacío!
                </p>

                <p class="text-lg text-gray-600 mb-4">
                    No hay productos en el carrito, pero no te preocupes, ¡puedes agregar algunos!
                </p>

                <a href="{{route('courses.index')}}"
                    class="inline-block mt-4 px-8 py-3 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    Ir a la tienda
                </a>
            </div>



            @endforelse

            <!-- Botón para limpiar carrito -->
            @if (Cart::instance('shopping')->count())
            <button wire:click="destroy" class="text-red-500 text-sm hover:text-red-700 transition">
                <i class="fas fa-trash-alt mr-2"></i> Limpiar carrito de compras
            </button>
            @endif
        </div>

        <!-- Resumen del pedido -->
        <div class="lg:col-span-2 p-6 bg-white rounded-lg shadow-md border border-gray-200">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Resumen del Pedido</h2>

            <!-- Subtotal y Total -->
            <div class="space-y-4">
                <div class="flex justify-between text-gray-700">
                    <p>Subtotal:</p>
                    <p class="font-medium">USD {{ Cart::subTotal() }}</p>
                </div>
                <hr class="border-gray-300">
                <div class="flex justify-between text-gray-800 font-bold text-lg">
                    <p>Total:</p>
                    <p>USD {{ Cart::subTotal() }}</p>
                </div>
            </div>

            <!-- Checkbox de términos y condiciones -->
            <div class="mt-6" x-data="{ acceptTerms: false }">
                <label class="flex items-start space-x-3 text-sm text-gray-600">
                    <input type="checkbox" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                        x-model="acceptTerms">
                    <span>
                        Acepto los <a href="#" class="text-red-500 underline hover:text-red-700">términos y
                            condiciones</a>
                    </span>
                </label>

                <!-- Botón de proceder al pago -->
                @if (Cart::instance('shopping')->count())
                <div class="space-y-4">
                    <!-- Botón -->
                    <a href="{{route('checkout.index')}}" wire:loading.attr="disabled"
                        wire:loading.class="cursor-not-allowed opacity-50"
                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-semibold text-white transition-all duration-150 ease-in-out bg-red-500 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
                        x-bind:disabled="!show" disabled="disabled">
                        Proceder con el pago
                    </a>
                </div>

                @else
                <button disabled class="mt-6 w-full px-6 py-3 text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed">
                    Proceder con el pago
                </button>
                @endif
            </div>

            <!-- Métodos de pago -->
            <div class="mt-8 flex justify-center">
                <img class="h-8" src="{{asset('img/credit-cards.png')}}" alt="Métodos de pago">
            </div>
        </div>
    </div>
</div>