<div>
    <x-container class="mt-5">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <aside class="col-span-1">
                <div class="mb-4">
                    <p class="text-lg font-semibold">Ordenar por:</p>
                    <x-select>
                        <option value="published_at">Más recientes</option>
                        <option value="students_count">Más Alumonos</option>
                        <option value="raiting">Mejor Calificado</option>
                    </x-select>
                </div>

                {{-- Filtrar por categorias --}}
                <div class="mb-4">
                    <p class="txt-lg font-semibold">Categorias</p>
                    <ul class="space-y-1">
                        @foreach($categories as $category)
                        <li>
                            <label>
                                <x-checkbox wire:model.live="selectedCategories" value="{{$category->id}}" />
                                {{$category->name}}
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                {{-- Filtrar por niveles --}}
                <div class="mb-4">
                    <p class="txt-lg font-semibold">Niveles</p>
                    <ul class="space-y-1">
                        @foreach($levels as $level)
                        <li>
                            <label>
                                <x-checkbox wire:model.live="selectedLevels" value="{{$level->id}}" />
                                {{$level->name}}
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                {{-- Filtrar por precios --}}
                <div>
                    <p class="txt-lg font-semibold">Precios</p>
                    <ul class="space-y-1">
                        <li>
                            <label>
                                <x-checkbox wire:model.live="selectedPrices" value="free" />
                                Gratis
                            </label>
                        </li>
                        <li>
                            <label>
                                <x-checkbox wire:model.live="selectedPrices" value="premium" />
                                Premium
                            </label>

                        </li>
                    </ul>
                </div>


            </aside>

            <div class="col-span-1 lg:col-span-3">

                <div class="mb-10">
                    <x-input wire:model.live="search" class="w-full" placeholder="Buscar Curso" />
                </div>
        
                <ul class="space-y-4">
                    @foreach($courses as $course)
                    <li wire:key="course-{{$course->id}}">
                        <a class="block sm:flex w-full" href="{{route('courses.show',$course)}}">
                            <figure>
                                <img class=" w-full sm:w-64 aspect-video object-cover object-center rounded-lg"
                                    src="{{$course->image}}" alt="{{$course->title}}">
                            </figure>
                            <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                                <h3 class="text-lg mb-1">{{$course->title}}</h3>

                                <p class="text-sm text-gray-600 mb-1">
                                    {{$course->summary}}
                                </p>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400 inline-flex items-center justify-center">{{$course->category->name}}</span>
                                    <span class="bg-blue-100 hover:bg-blue-200 text-gray-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400 inline-flex items-center justify-center">{{$course->level->name}}</span>

                                    
                                </p>
                                <p class="text-sm text-gray-500 mb-1">
                                    <span class="font-semibold">Prof:</span> {{$course->teacher->name}}
                                </p>

                                <div class="flex items-center">
                                    <ul class="flex items-center text-xs space-x-1">
                                        <li>
                                            <i class="fas fa-star text-yellow-400"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star text-yellow-400"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star text-yellow-400"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star text-yellow-400"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star text-yellow-400"></i>
                                        </li>
                                    </ul>
                                    <span class="text-sm text-gray-500 font-semibold ml-1">
                                        (5)
                                    </span>
                                </div>
                                <p class="font-semibold mb-2">
                                @if ($course->price->value ==0)
                                <span class="bg-blue-100 text-green-500 text-sm font-medium me-2 px-2.5 py-0.5 rounded ">Gratis</span>
                                @else
                                <span class="bg-blue-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded">${{number_format($course->price->value,2)}}</span>
                                @endif
                            </p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="mt-8">
                      {{$courses->links()}}
                </div>
            </div>
        </div>
    </x-container>
</div>