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
        <x-input type="password" name="password" class="w-full" />
      </div>

      <div class="mb-4">
        <x-label class="mb-1">Confirmar Contraseña</x-label>
        <x-input type="password" name="password_confirmation" class="w-full" />
      </div>



      <div class="flex justify-end space-x-2">
        <x-danger-button onclick="confirmDelete()">Eliminar</x-danger-button>
        <x-button>Actualizar</x-button>
      </div>
    </form>
  </div>


  <form action="{{route('admin.users.destroy',$user)}}" method="POST" id="deleteForm">
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