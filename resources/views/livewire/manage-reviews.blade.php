<div>
    <div class="grid grid-cols-4 gap-6">
        <div class="col-span-1">

            <p class="text-6xl font-bold text-center">
                {{$course->rating}}
            </p>
            <x-start class="justify-center" rating="{{$course->rating}}" />
            <p class="text-lg text-center">Valoraciones</p>
        </div>

        <div class="col-span-3">
            <ul>
                @for ($i =5; $i>=1; $i--)
                <li class="flex items-center">
                    <x-progress-bar
                        width="{{round($course->reviews->where('rating',$i)->count() *100 / $course->reviews->count() ,2) }}"
                        class="flex-1" />
                    <x-start rating={{$i}} class="ml-4 mr-2" />
                    <span class="w-16">
                        {{round($course->reviews->where('rating',$i)->count() *100 / $course->reviews->count() ,2) }}%
                    </span>
                </li>
                @endfor
            </ul>
        </div>
    </div>

    <ul class="space-y-6">
        @foreach ($reviews as $review)
        <li class="flex space-x-8">
            <figure class="shrink-0">
                <img class="w-10 h-10 object-cover object-center rounded-full"
                    src="{{$review->user->profile_photo_url}}" alt="">
            </figure>

            <div class="flex-1">
                <p>{{$review->user->name}}</p>

                <div class="flex space-x-2 items-center">
                    <x-start rating="{{$review->rating}}" class="inline" />
                    <p class="text-sm">
                        {{$review->created_at->diffForHumans()}}
                    </p>
                </div>
                <div>
                    {{$review->comment}}
                </div>
            </div>

            <div class="shrink-0">
                <x-dropdown>
                    <x-slot name="trigger">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link wire:click="edit({{$review}})">
                            Editar
                        </x-dropdown-link>
                        <x-dropdown-link wire:click="delete({{$review}})">
                            Eliminar
                        </x-dropdown-link>'
                    </x-slot>


                </x-dropdown>
            </div>



        </li>
        @endforeach
    </ul>


    <x-dialog-modal wire:model="editReview.open">
        <x-slot name="title">
            <p class="text-3xl font-semibold text-center mt-4">Tu opinion es importante!</p>
        </x-slot>
        <x-slot name="content">
            <p class="text-center mb-4">
                ¿Como fue tu experiencia?
            </p>

            <ul x-data="{rating:@entangle('editReview.rating')}" class="flex justify-center space-x-3 text-gray-600">
                <li>
                    <button x-on:click="rating =1">
                        <i class="fas fa-star text-2xl" x-bind:class="rating >=1 ? 'text-yellow-500':''"></i>
                    </button>
                </li>

                <li>
                    <button x-on:click="rating =2">
                        <i class="fas fa-star text-2xl" x-bind:class="rating >=2 ? 'text-yellow-500':''"></i>
                    </button>
                </li>
                <li>
                    <button x-on:click="rating =3">
                        <i class="fas fa-star text-2xl" x-bind:class="rating >=3 ? 'text-yellow-500':''"></i>
                    </button>
                </li>
                <li>
                    <button x-on:click="rating =4">
                        <i class="fas fa-star text-2xl" x-bind:class="rating >=4 ? 'text-yellow-500':''"></i>
                    </button>
                </li>
                <li>
                    <button x-on:click="rating =5">
                        <i class="fas fa-star text-2xl" x-bind:class="rating >=5 ? 'text-yellow-500':''"></i>
                    </button>
                </li>
            </ul>

            <x-textarea wire:model="editReview.comment" class="w-full mt-4" placeholder="Mensaje......."></x-textarea>

        </x-slot>
        <x-slot name="footer">

            <x-button wire:click="update">
                Actualizar Reseña
            </x-button>
        </x-slot>

    </x-dialog-modal>
</div>