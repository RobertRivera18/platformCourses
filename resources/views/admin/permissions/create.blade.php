<x-admin-layout :breadcrumb="[
[
  'name'=>'Dashboard',
  'url'=>route('admin.dashboard')

],
[
'name'=>'Permisos',
'url'=>route('admin.permissions.index')

],
[
'name'=>'Nuevo Permiso'
],

]">

  <form action="{{route('admin.permissions.store')}}" method="POST">
    @csrf
    <div class="card">
      <div class="mb-4">
        <x-label class="mb-1">Nombre del Permiso</x-label>
        <x-input name="name" value="{{old('name')}}" class="w-full" />
      </div>
      <div class="flex justify-end space-x-2">
        <x-button>Guardar</x-button>
      </div>
    </div>

  </form>

</x-admin-layout>