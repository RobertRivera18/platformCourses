<div>
    <div class="grid grid-cols-3 gap-6">

        <div class="col-span-2">

            <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/{{$current->video_path}}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <h1 class="text-3xl font-semibold mt-4">
                {{$lessons->pluck('id')->search($current->id)+1}}.
                {{$current->name}}</h1>

            @if ($current->description)
            <p class="text-gray-600 mt-4">
                {{$current->description}}
            </p>
            @endif


            @auth
            <div class="flex items-center space-x-2">
                <x-toggle wire:model='completed' /> Marca esta unidad como terminada
            </div>
            @endauth


            <div class="card px-6 py-4 mt-2">
                <div class="flex justify-between">
                    <button wire:click="previousLesson()">Tema Anterior</button>
                    <button wire:click="nextLesson()">Siguiente Tema</button>
                </div>
            </div>
        </div>

        <aside class="col-span-1">
            <div class="card">
                <h1 class=" leading-8 text-2xl text-center mb-4">
                    <a class="hover:text-blue-600 " href="{{route('courses.show',$course)}}">
                        {{$course->title}}
                    </a>
                </h1>

                <div class="flex items-center">
                    <figure class="mr-4">
                        <img class="rounded-full w-12 h-12 object-cover" src="{{$course->teacher->profile_photo_url}}"
                            alt="">
                    </figure>

                    <div class="flex-1">
                        <p>{{$course->teacher->name}}</p>
                    </div>

                </div>

                {{--Avance del curso---}}
                <div class="mt-2">
                    <p class="text-gray-600 text-sm">{{$advance}}% Completado</p>


                    <div class="relative pt-1">
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                            <div style="width:{{$advance}}%"
                                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500">
                            </div>
                        </div>
                    </div>
                </div>


                {{--Secciones---}}
                <ul class="space-y-5 text-gray-600">
                    @foreach ($sections as $section)
                    <li x-data={open:false}>
                        <button class="text-left flex justify-between" x-on:click="open=!open">
                            <span>{{$section['name']}}</span>
                            <i class="mt-1 fas fa-angle-down"></i>
                        </button>
                        <ul class="space-y-1 mt-2" x-show="open" x-cloak>
                            <li >
                                @foreach ($section['lessons'] as $lesson)
                            <li>
                                <a class="w-full flex" href="{{route('courses.status',[$course,$lesson['slug']])}}">
                                    <i
                                        class="fas {{$lesson['id']==$current->id ? 'fa-circle-dot' :'fa-circle'}}  mt-1 mr-2  {{$open_lessons->where('lesson_id', $lesson['id'])->where('user_id', auth()->id())->where('completed', 1)->count()?'text-yellow-400' : ''}}"></i>
                                    <span>
                                        {{$lessons->pluck('id')->search($lesson['id'])+1 }}. {{$lesson['name']}}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                    </li>
                </ul>
                </li>
                @endforeach
                </ul>
            </div>
        </aside>
    </div>
</div>