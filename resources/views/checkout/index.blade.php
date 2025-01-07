<x-app-layout>
    <x-container class="mt-7">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-12">

            <div class="order-2 lg:order-1 lg:col-span-3">
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
                            </li>
                            @empty
                            <li>No hay productos en el carrito</li>
                            @endforelse
                        </ul>
                    </div>
                </div>



            </div>

            <div class="order-1 lg:order-2 lg:col-span-2">
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


                        <div id="paypal-button-container"></div>



                    </div>
                    <div class="flex justify-center items-center mt-5">
                        <img class="h-8" src="{{asset('img/credit-cards.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </x-container>
    @push('js')
    <script src="https://www.paypal.com/sdk/js?client-id={{config('services.paypal.client_id')}}&currency=USD"
        data-sdk-integration-source="developer-studio"></script>
    <script>
        paypal.Buttons({
           createOrder(){
            return axios.post("{{route('checkout.createPaypalOrder')}}")
            .then(resp=>{
                return resp.data.id;
            }).catch(err=>{
                console.log(err)
            });
           },
           onApprove(data){

           },
            }).render('#paypal-button-container')
    </script>
    @endpush
</x-app-layout>