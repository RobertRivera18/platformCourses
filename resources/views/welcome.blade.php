<x-app-layout>
    <figure class="mb-8">
        <img class="w-full aspect-[3/1] object-cover object-center"
            src="{{asset('img/welcome/laptop-2620118_1280.jpg')}}" alt="">
    </figure>
    <section class="mb-20">
        <x-container>
            <h1 class="text-2xl font-semibold mb-6 text-center">
                Contenido
            </h1>

            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <li>
                    <a href="">
                        <img class="aspect-video object-cover object-center rounded-lg"
                            src="https://codersfree.com/img/servicios/cursos.jpeg" alt="">
                    </a>
                    <h1 class="text-lg text-center font-semibold mt-4 mb-2">
                        <a href="">
                            Cursos Online
                        </a>
                    </h1>
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, officiis quosm.</p>
                </li>

                <li>
                    <a href="">
                        <img class="aspect-video object-cover object-center rounded-lg"
                            src="https://codersfree.com/img/servicios/desarrollo.jpeg" alt="">
                    </a>
                    <h1 class="text-lg text-center font-semibold mt-4 mb-2">
                        <a href="">
                            Diseño Web
                        </a>
                    </h1>
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, officiis quosm.</p>
                </li>

                <li>
                    <a href="">
                        <img class="aspect-video object-cover object-center rounded-lg"
                            src="https://codersfree.com/img/servicios/asesorias.jpg" alt="">
                    </a>
                    <h1 class="text-lg text-center font-semibold mt-4 mb-2">
                        <a href="">
                            Asesorías
                        </a>
                    </h1>
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, officiis quosm.</p>
                </li>

                <li>
                    <a href="">
                        <img class="aspect-video object-cover object-center rounded-lg"
                            src="https://codersfree.com/img/servicios/blog.jpeg" alt="">
                    </a>
                    <h1 class="text-lg text-center font-semibold mt-4 mb-2">
                        <a href="">
                            Blog
                        </a>
                    </h1>
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, officiis quosm.</p>
                </li>
            </ul>
        </x-container>

    </section>

    <section>
        <h1 class="text-xl text-center mb-3">Ultimos Cursos</h1>
        <x-container>
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($courses as $course)
                <li>
                    <div class="bg-white rounded-lg overflow-hidden">
                        <figure>
                            <img class="w-full aspect-video object-center object-cover" src="{{$course->image}}"
                                alt="{{$course->title}}">
                        </figure>
                        <div class="px-6 pt-4 pb-5">
                            <h1 class="line-clamp-2 leading-5 min-h-[42px] mb-1">
                                <a href="{{route('courses.show',$course)}}">{{$course->title}}</a>
                            </h1>
                            <p class="text-gray-500 text-sm mb-1">
                                Prof: {{$course->teacher->name}}
                            </p>
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
                            <p class="font-semibold mb-2">
                                @if ($course->price->value ==0)
                                <span class="bg-blue-100 text-green-500 text-sm font-medium me-2 px-2.5 py-0.5 rounded ">Gratis</span>
                                @else
                                <span class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">${{number_format($course->price->value,2)}}</span>

                                @endif
                            </p>
                            <a class="btn btn-blue block w-full text-center" href="{{route('courses.show',$course)}}">Mas información</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </x-container>
    </section>
</x-app-layout>