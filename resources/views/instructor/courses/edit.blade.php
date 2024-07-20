<x-instructor-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Curso:{{$course->title}}
        </h2>
    </x-slot>

    <x-container class="py-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 ">
            <aside class="col-span-1">
                <nav>
                    <ul>
                        <li class="border-l-4 border-indigo-400 pl-3">
                            <a href="">
                                Información del Curso
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <div class="col-span-1 lg:col-span-4">
                <div class="card">
                    <form action="{{route('instructor.courses.update',$course)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <p class="text-2xl font-semibold">Información del Curso</p>
                        <hr class="mt-2 mb-6">

                        <x-validation-errors class="mb-4" />

                        <div class="mb-4">
                            <x-label value="Titulo del Curso" class="mb-1" />
                            <x-input type="text" class="w-full" value="{{old('title',$course->title)}}" name="title" />
                        </div>

                        @empty($course->published_at)

                        <div class="mb-4">
                            <x-label value="Slug del curso" class="mb-1" />
                            <x-input type="text" class="w-full" value="{{old('slug',$course->slug)}}" name="slug" />
                        </div>
                        @endempty



                        <div class="mb-4">
                            <x-label value="Decripción del Curso" class="mb-1" />
                            <x-textarea id="editor" class="w-full" name="description">
                                {{old('description',$course->description)}}
                            </x-textarea>
                        </div>
                        <div class="mb-4">
                            <x-label value="Resumen" class="mb-1" />
                            <x-textarea class="w-full" name="summary">{{old('summary',$course->summary)}}</x-textarea>
                        </div>


                        <div class="grid md:grid-cols-3 gap-4 mb-8">
                            <div>
                                <x-label class="mb-1">
                                    Categorias
                                </x-label>
                                <x-select class="w-full" name="category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $course->
                                        category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div>
                                <x-label class="mb-1">
                                    Niveles
                                </x-label>
                                <x-select class="w-full" name="level_id">
                                    @foreach ($levels as $level)
                                    <option value="{{$level->id}}" @selected(old ('level_id',$course->level_id) ==
                                        $level->id)>
                                        {{$level->name}}
                                    </option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div>
                                <x-label class="mb-1">
                                    Precios
                                </x-label>
                                <x-select class="w-full" name="price_id">
                                    @foreach ($prices as $price)
                                    <option value="{{ $price->id }}" @selected(old('price_id', $course->price_id) ==
                                        $price->id)>
                                        @if($price->value == 0)
                                        Gratis
                                        @else
                                        {{ $price->value }} US$ (nivel {{ $loop->index }})
                                        @endif
                                    </option>
                                    @endforeach
                                </x-select>
                            </div>

                        </div>

                        <div>
                            <p class="text-2xl font-semibold mb-2">
                                Imagen del curso
                            </p>
                            <div class="grid md:grid-cols-2 gap-4">
                                <figure>
                                    <img class="w-full aspect-video object-cover object-center" src="{{$course->image}}"
                                        alt="">
                                </figure>

                                <div>
                                    <p class="mb-2">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque magnam, eum
                                        nobis, cupiditate quisquam dolorum modi animi ipsam exercitationema.
                                    </p>
                                    <label>
                                        <span class="btn btn-blue md:hidden cursor-pointer">
                                            Selecciona una imagen</span>
                                        <input class="hidden md:block" type="file" accept="image/*" class="mb-2"
                                            name="image">
                                    </label>

                                    <div class="flex md:justify-end mt-4">
                                        <x-button>
                                            Guardar Cambios
                                        </x-button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-container>
    @push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
         .create(document.querySelector('#editor'))
         .catch(error => {
         })
    </script>
    @endpush
</x-instructor-layout>