<x-admin-layout :breadcrumb="[
[
  'name'=>'Dashboard',
  'url'=>route('admin.dashboard')
],

]">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card">

            <div class="flex">

                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}">
                <div class="ml-4">

                    <p class="text-lg font-semibold">
                        Bienvenido, {{auth()->user()->name}}
                    </p>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="text-sm hover:text-blue-400">
                            Cerrar Sesion
                        </button>

                    </form>
                </div>

            </div>

        </div>
        <div class="card">
            <div class="flex h-full items-center justify-center">
                <p class="text-2xl font-semibold">
                    PlatformCourse
                </p>
            </div>


        </div>
</x-admin-layout>