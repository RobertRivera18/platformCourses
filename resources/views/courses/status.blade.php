<x-app-layout>

    <x-container class="mt-8">
        @livewire('course-status',
        ['course' => $course,
        'lessons' => $lessons->pluck('id'),
        'sections'=>$sections->toArray(),
        'current'=> $lesson
        ])

    </x-container>
</x-app-layout>