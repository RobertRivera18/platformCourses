<div>
    <div class="grid grid-cols-3 gap-6">

        <div class="col-span-2">

            <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/{{$current->video_path}}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <h1 class="text-3xl font-semibold mt-4">
                {{$lessons->search($current->id)+1}}.
                {{$current->name}}</h1>

            @if ($current->description)
            <p class="text-gray-600 mt-4">
                {{$current->description}}
            </p>
            @endif
            <div class="flex items-center space-x-2">
                <x-toggle /> Marca esta unidad como terminada
            </div>

            <div class="card px-6 py-4 mt-2">
                <div class="flex justify-between">
                    <a href="">Tema Anterior</a>
                    <a href="">Tema Siguiente</a>
                </div>
            </div>
        </div>

        <aside class="col-span-1">
            <div class="card">
                <h1>
                    {{$course->title}}
                </h1>
            </div>
        </aside>
    </div>
</div>x