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
'name'=>'Roles',
'url'=>route('admin.roles.index')

],
[
'name'=>'Editar',

],

]">

<form action="{{route('admin.roles.update',$role)}}" method="POST">
  @csrf
  @method('PUT')
  <div class="card">
    <div class="mb-4">
      <x-label class="mb-1">Nombre del Rol</x-label>
      <x-input name="name" value="{{old('name',$role->name)}}" class="w-full" />
    </div>

    <div class="mb-4">
      <x-label class="mb-1">Permisos</x-label>
      <ul>
        @foreach ($permissions as $permission)
         <li>
          <label >
            <x-checkbox  name="permissions[]" value="{{$permission->id}}" :checked="in_array($permission->id, old('permissions',$role->permissions->pluck('id')->toArray()))" />
            {{$permission->name}}
          </label>
         </li>
        @endforeach
      </ul>
    </div>

    <div class="flex justify-end space-x-2">
     <x-button>Guardar</x-button>
     <x-danger-button>Eliminar</x-danger-button>
    </div>
  </div>

</form>


</x-admin-layout>