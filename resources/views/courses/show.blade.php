<x-app-layout>
    <x-container class="mt-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="cols-span-1 lg:col-span-2 order-2 lg:order-1">
                <div class="mb-8">
                    <h1 class="text-3xl font-semibold mb-1">
                        {{$course->title}}
                    </h1>
                    <p class="mb-2">
                        {{$course->summary}}
                    </p>

                    <figure>
                        <img class="w-full aspect-video object-cover object-center" src="{{$course->image}}" alt="">
                    </figure>
                </div>
                {{-- Objetivos --}}

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Objetivos del Curso</h2>
                    <div class="card">
                        <ul class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            @foreach($course->goals as $goal)
                            <li class="flex space-x-4">
                                <i class="far fa-circle-check text-lg"></i>
                                <p class="text-sm">{{$goal->name}}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                {{-- Lecciones --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Temario</h2>
                    <ul class="space-y-4">
                        @foreach($course->sections as $section)
                        <li x-data="{
                        open:false
                        }">
                            <div class="card">
                                <button x-on:click="open = !open" class="flex w-full text-left p-2 bg-gray-50 border-b">
                                    <span class="text-md font-semibold">
                                        {{$section->name}}
                                    </span>
                                    <span class="ml-auto">
                                        {{$section->lessons->count()}}
                                        clases</span>
                                </button>


                                <div class="p-4" x-show="open" x-cloak>
                                    <ul>
                                        @foreach($section->lessons as $lesson)
                                        <li>
                                            <a class="flex" href="">
                                                <i class="far fa-play-circle text-blue-500 mt-0.5 mr-2"></i>
                                                <span
                                                    class="font-semibold text-gray-600 hover:text-blue-800 text-sm">{{$lesson->name}}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Requerimientos --}}
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4">Requerimientos</h2>
                    <ul class="list-disc list-inside">
                        @foreach ($course->requeriments as $requeriment)
                        <li>
                            {{$requeriment->name}}
                        </li>
                        @endforeach
                    </ul>
                </div>
                {{-- Descripcion del Curso --}}
                <div>
                    <h2 class="text-lg font-semibold mb-4">Descripción</h2>
                    <div>
                        {!!$course->description!!}
                    </div>
                </div>
            </div>

            <div class="col-span-1 order-1 lg:order-2">
                <div class="card">
                    <div class="mb-4">
                        <p class="text-2xl  text-center font-semibold mb-2">
                            @if ($course->price->value ==0)
                            <span class=" text-green-500 ">Gratis</span>
                            @else
                            <span class=" text-gray-800">
                                ${{number_format($course->price->value,2)}}
                            </span>
                            @endif
                        </p>
                        <button class="btn btn-blue w-full mb-2">Agregar al Carrito</button>
                        <button class="btn btn-red w-full ">Comprar Ahora</button>

                    </div>
                    <div>
                        <p class="font-semibold text-lg">Detalles del Curso</p>
                        <ul class="space-y-1">
                            <li>
                                <i class="far fa-calendar-alt inline-block w-6"></i> Ultima Actualización {{$course->updated_at->format('d/m/Y')}}
                            </li>

                            <li>
                                <i class="fas fa-clock inline-block w-6"></i> Duración: 120 Horas
                            </li>
                            <li>
                                <i class="fa fa-chart-line inline-block w-6"></i> Nivel {{$course->level->name}}
                            </li>
                            <li>
                                <i class="fas fa-star inline-block w-6"></i> Calificación: 5 
                            </li>
                            <li>
                                <i class="fas fa-infinity inline-block w-6"></i> Acceso de por Vida
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </x-container>
</x-app-layout>