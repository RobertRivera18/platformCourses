<x-instructor-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Curso:{{$course->title}}
        </h2>
    </x-slot>

    <x-container class="py-8">
        <x-instructor.courses-sidebar :course="$course">
             @livewire('instructor.courses.manage-section',['course'=>$course])
        </x-instructor.courses-sidebar>
    </x-container>
    @push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    @endpush
</x-instructor-layout>