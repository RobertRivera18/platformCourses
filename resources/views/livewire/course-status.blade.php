<div>

    @push('css')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    @endpush
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="col-span-2 lg:col-span-2">


            @if (Gate::allows('enrolled',$course)||$current->is_preview||$course->price->value==0)
            <div wire:ignore>
                @if ($current->platform==1)

                <video id="player" playsinline controls data-poster="/path/to/poster.jpg">
                    <source src="{{Storage::url($current->video_path)}}" type="video/mp4">
                </video>
                @else


                <div class="plyr__video-embed" id="player">
                    <iframe src="https://www.youtube.com/embed/{{$current->video_path}}" allowfullscreen
                        allowtransparency allow="autoplay"></iframe>
                </div>
                @endif
            </div>

            @else

            <div class="relative">
                <figure>
                    <img class="w-full aspect-video object-cover object-center" src="{{$current->image}}" alt="">
                </figure>

                <div
                    class="absolute inset-0 bg-black bg-opacity-40 sm:px-24 flex flex-col justify-center items-center space-y-6 md:space-y-8 lg:space-y-10 text-white">
                    <p class="hidden md:block uppercase text-3xl font-mono font-bold text-center">Adquiere este
                        curso para tener acceso a todas las lecciones</p>

                    <i class="fas fa-unlock-alt text-5xl"></i>

                    <a href="{{route('courses.show',$course)}}" class="btn btn-red" data-turbo="false">
                        <span class="text-sm sm:text-base">Comprar curso</span>
                    </a>
                </div>
            </div>
            @endif

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

        <div class="col-span-1">
            <aside class="card mb-4">
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
                    <li x-data="{open:'{{$section['id']==$current->section_id}}'}">
                        <button class="text-left flex justify-between" x-on:click="open=!open">
                            <span>{{$section['name']}}</span>
                            <i class="mt-1 fas" x-bind:class="open ? 'fa-angle-up':'fa-angle-down'"></i>
                        </button>
                        <ul class="space-y-1 mt-2" x-show="open" x-cloak>
                            <li>
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
            </aside>

            <x-button wire:click="$set('review.open',true)" class="w-full flex justify-center">Calificar este Curso
            </x-button>
        </div>
    </div>



    <x-dialog-modal wire:model="review.open">
        <x-slot name="title">
            <p class="text-3xl font-semibold text-center mt-4">Tu opinion es importante!</p>
        </x-slot>
        <x-slot name="content">
            <p class="text-center mb-4">
                ¿Como fue tu experiencia?
            </p>

            <ul x-data="{rating:@entangle('review.rating')}"class="flex justify-center space-x-3 text-gray-600">
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
        </x-slot>
        <x-slot name="footer"></x-slot>

    </x-dialog-modal>

    @push('js')
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>

    <script>
        const player = new Plyr('#player');
        player.on('ready', (event) => {
        player.play();
});

player.on('ended', (event) => {
      @this.call('completedLesson')
});
    </script>
    @endpush
</div>