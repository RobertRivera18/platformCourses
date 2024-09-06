<div x-data="{
destroySection(sectionId){
 Swal.fire({
  title: 'Estas Seguro',
  text: 'No podras revertir esto!',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: '¡Si, borralo!',
  cancelButtonText:'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
     @this.call('destroy',sectionId)
  }
});
}

}">
    {{-- Listar secciones --}}
    <ul class="mb-6 space-y-6">
        @foreach($sections as $section)
        <li>
            <div class="bg-gray-100 rounded-lg shadow-lg px-6 py-4">

                @if ($sectionEdit['id']==$section->id)
                   <form wire:submit="update">
                        <div class="flex items-center space-x-2">
                            <x-label>
                                Sección {{$section->position}}:
                            </x-label>
                        
                                <x-input wire:model="sectionEdit.name" class="flex-1"/>
                        
                        </div>
                        <div class="flex justify-end mt-4">
                             <div class="space-x-2">
                                <x-danger-button wire:click="$set('sectionEdit.id',null)">Cancelar</x-danger-button>
                             <x-button>Actualizar</x-button>
                             </div>
                        </div>
                   </form>
                @else
                    
                <div class="md:flex md:items-center">
                    <h1 class="md:flex-1 truncate">
                        Seccion{{$section->position}} :
                        <br class="md:hidden">
                        <span class="font-semibold">
                            {{$section->name}}
                        </span>
                    </h1>

                    <div class="space-x-3 md:shrink-0 md:ml-4">
                        <button wire:click="edit({{$section->id}})">
                            <i class="fa fa-edit hover:text-indigo-600"></i>
                        </button>

                        <button x-on:click="destroySection({{$section->id}})">
                            <i class="fa fa-trash-alt hover:text-red-600"></i>
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </li>

        @endforeach
    </ul>
    {{-- Crear secciones --}}
    <form wire:submit="store">
        <div class="bg-gray-100 rounded-lg shadow-lg p-6">
            <x-label>Nueva sección</x-label>
            <x-input wire:model="name" class="w-full" palceholder="Ingrese el nombre de la sección" />
            <x-input-error for="name" />
            <div class="flex justify-end mt-4">
                <x-button>Agregar Sección</x-button>
            </div>
        </div>
    </form>
</div>