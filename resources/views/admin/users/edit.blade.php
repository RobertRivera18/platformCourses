<x-admin-layout :breadcrumb="[
[
  'name'=>'Dashboard',
  'url'=>route('admin.dashboard')

],
[
'name'=>'Usuarios',
'url'=>route('admin.users.index')


],

[
'name'=>'Editar',

]
]">


  <div class="card">
    <form action="{{route('admin.users.update',$user)}}" method="POST">
      @method('PUT')
      @csrf
      <x-validation-errors class="mb-4" />
      <div class="mb-4">
        <x-label class="mb-1">Nombre</x-label>
        <x-input name="name" value="{{old('name',$user->name)}}" required class="w-full" />
      </div>

      <div class="mb-4">
        <x-label class="mb-1">Email</x-label>
        <x-input type="email" name="email" value="{{old('email',$user->email)}}" required class="w-full" />
      </div>

      <div class="mb-4">
        <x-label class="mb-1">Contraseña</x-label>
        <x-input type="password" name="password"  class="w-full" />
      </div>

      <div class="mb-4">
        <x-label class="mb-1">Confirmar Contraseña</x-label>
        <x-input type="password" name="password_confirmation"  class="w-full" />
      </div>



      <div class="flex justify-end">
        <x-button>Actualizar</x-button>
      </div>
    </form>
  </div>
</x-admin-layout>