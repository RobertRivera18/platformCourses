<div>
    @push('css')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    @endpush
    <h1 class="text-2xl font-semibold">Video Promocional</h1>
    <hr class="mt-2 mb-6">
    <div class="grid grid-cols-2 gap-6">
        <div class="col-span-1">
            @if($course->video_path)
                <video id="player" class="aspect-video" playsinline controls data-poster="{{$course->image}}">
                    <source src="{{Storage::url($course->video_path)}}">
                </video>
            @else
            <figure>
                <img class="aspect-video w-full object-cover" src="{{$course->image}}" alt="{{$course->title}}">
            </figure>
            @endif
        </div>
        <div class="col-span-1">
            <form wire:submit="save">
                <x-validation-errors/>
                <p class="mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem corporis fugit reprehenderit odit,
                    magnam, ipsum eveniet quasi possimus veritatis quos recusandae quam labore hic, unde vel omnis
                    aspernatur dolore vero!
                </p>
                <x-instructor.progress-indicator wire:model="video" />
                <div class="flex justify-end mt-4">
                    <x-button>
                        Subir Video
                    </x-button>
                </div>
            </form>
        </div>
    </div>
    @push('js')
        
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script>
        const player = new Plyr('#player');
    </script>
    @endpush
</div>