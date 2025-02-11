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
            <label>
              <x-checkbox name="permissions[]" value="{{$permission->id}}"
                :checked="in_array($permission->id, old('permissions',$role->permissions->pluck('id')->toArray()))" />
              {{$permission->name}}
            </label>
          </li>
          @endforeach
        </ul>
      </div>

      <div class="flex justify-end space-x-2">
        <x-danger-button onclick="confirmDelete()">Eliminar</x-danger-button>
        <x-button>Actualizar</x-button>
      </div>
    </div>

  </form>



  <form action="{{route('admin.roles.destroy',$role)}}" method="POST" id="deleteForm">
    @method('DELETE')
    @csrf


  </form>
  @push('js')
  <script>
    function confirmDelete(){
      Swal.fire({
  title: "¿Estás seguro?",
  text: "Esta acción no se puede deshacer.",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#4CAF50", // Verde suave
  cancelButtonColor: "#F44336", // Rojo suave
  confirmButtonText: "Eliminar",
  cancelButtonText: "Cancelar",
  buttonsStyling: true,
  customClass: {
    popup: "minimalist-alert",
    title: "minimalist-alert-title",
    confirmButton: "minimalist-confirm-button",
    cancelButton: "minimalist-cancel-button"
  }
}).then((result) => {
  if (result.isConfirmed) {
     document.getElementById('deleteForm').submit()
  }
});


   }

  </script>
  @endpush

</x-admin-layout>