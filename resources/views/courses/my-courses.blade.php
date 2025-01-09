<x-app-layout>
    <x-container class="max-w-5xl py-6 mt-20">
        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($courses as $course)
            <li class="overflow-hidden">
                <a class="block" href="{{route('courses.status',$course)}}">
                    <figure>
                        <img class="rounded-lg w-full aspect-video object-cover object-center" src="{{$course->image}}"
                            alt="{{$course->name}}">
                    </figure>

                    <h2 class="mt-1 truncate">{{$course->title}}</h2>

                </a>
            </li>

            @empty
            <li class="col-span-1  sm:col-span-2 md:col-span-3 lg:col-span-4">
                <div class="card">
                    <figure>
                        <img class="w-64 mx-auto" src="https://img.freepik.com/free-vector/website-faq-section-user-help-desk-customer-support-frequently-asked-questions-problem-solution-quiz-game-confused-man-cartoon-character_335657-1602.jpg?t=st=1736454230~exp=1736457830~hmac=d08d4477957a5ecc0a49a44921d6161f3927e1f7bf9001a959cbffcff7439fa1&w=740" alt="">
                    </figure>
                    <p class="my-2 text-center">
                        Parece que aun no tienes cursos matriculados.
                    </p>
                    <div class="flex justify-center">
                             <a href="{{route('courses.index')}}" class="btn btn-blue">Comprar un curso</a>
                    </div>
                </div>
            </li>
            @endforelse

        </ul>





    </x-container>
</x-app-layout>