<div>

    @if(count($requeriments))
    <ul class=" space-y-2 mb-4" id="requeriments">
        @foreach ($requeriments as $index=> $requeriment)
        <li wire:key="requeriment-{{$requeriment['id'] }}" data-id="{{$requeriment['id']}}">
            <div class="flex">
                <x-input wire:model="requeriments.{{$index}}.name" class="flex-1 rounded-r-none" />
                <div class="border  border-l-0 border-gray-300 rounded-r divide-x-2 divide-gray-300">
                    <div class="flex items-center h-full">
                        <button class="px-2 hover:text-red-500" onclick="destroyRequeriment({{$requeriment['id']}})">
                            <i class="far fa-trash-alt"></i>
                        </button>


                        <div class="flex items-center px-2 cursor-move">
                            <i class="fas fa-bars"></i>
                        </div>

                    </div>

                </div>
            </div>

        </li>
        @endforeach
    </ul>
    <div class="flex justify-end mb-8">
        <x-button wire:click="update">Actualizar</x-button>
    </div>
    @endif

    <form wire:submit="store">
        <div class="bg-gray-100 rounded-lg shadow-lg p-6">
            <x-label>Nuevo Requerimiento</x-label>
            <x-input wire:model="name" class="w-full" palceholder="Ingrese el nombre del requerimiento" />
            <x-input-error for="name" />
            <div class="flex justify-end mt-4">
                <x-button>Agregar Requerimiento</x-button>
            </div>
        </div>
    </form>

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        const requeriments=document.querySelector('#requeriments');
        const sortable=new Sortable(requeriments,{
            animation:150,
            ghostClass:'blue-background-class',
            store:{
                set:(sortable)=>{
                   @this.call('sortRequeriments', sortable.toArray())
                }
            }
        });
    </script>
    <script>
        function destroyRequeriment(id){
                Swal.fire({
  title: "Estás Seguro?",
  text: "¡No podrás revertir esto!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "¡Si, eliminarlo!",
  cancelButtonText:"Cancelar"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
  icon: 'success',
  text: "El requerimiento ha sido eliminado con éxito.",
  timer: 3000,
  timerProgressBar: true,
  toast: true,
  position: "top-end",
  showConfirmButton: false
});

    @this.call('destroy',id)
  }

});
            }
    </script>
    @endpush
</div>