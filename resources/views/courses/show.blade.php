<x-app-layout>
    <x-container class="mt-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="cols-span-1 lg:col-span-2 order-2 lg:order-1">
                <div class="mb-6">
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

                <div class="mb-4">
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
                    <h2 class="text-xl font-semibold mb-2">Temario</h2>
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
                                            <a href="{{route('courses.status',[$course,$lesson])}}" class="flex" href="">
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
                <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
                    <div class="mb-6">
                        @can('enrolled',$course)
                        <!-- Detalles si el curso ya está adquirido -->
                        <p class="flex items-center mb-2 text-gray-700">
                            <svg class="fill-current h-5 w-5 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-6h2v6zm0-8h-2V7h2v4z" />
                            </svg>
                            <span class="font-semibold">Adquirido el {{$course->dateOfAcquisition}}</span>
                        </p>
                        <a class="w-full inline-block text-center py-3 px-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            href="{{route('courses.status',$course)}}">
                            Continuar con el Curso
                        </a>
                        @else
                        <!-- Detalles si el curso no ha sido adquirido -->
                        <p class="text-2xl font-semibold text-center mb-4">
                            @if ($course->price->value == 0)
                            <span class="text-green-500">Gratis</span>
                            @else
                            <span class="text-gray-800">${{ number_format($course->price->value, 2) }}</span>
                            @endif
                        </p>
                        @livewire('course-enrolled', ['course' => $course])
                        @endcan
                    </div>

                    <div>
                        <p class="font-semibold text-lg text-gray-800 mb-2">Detalles del Curso</p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center">
                                <i class="far fa-calendar-alt w-6 text-gray-500"></i>
                                <span>Última Actualización: {{$course->updated_at->format('d/m/Y')}}</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-clock w-6 text-gray-500"></i>
                                <span>Duración: 120 Horas</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fa fa-chart-line w-6 text-gray-500"></i>
                                <span>Nivel: {{$course->level->name}}</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-star w-6 text-gray-500"></i>
                                <span>Calificación: 5</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-infinity w-6 text-gray-500"></i>
                                <span>Acceso de por Vida</span>
                            </li>
                        </ul>
                    </div>
                </div>



            </div>
        </div>
    </x-container>
</x-app-layout>