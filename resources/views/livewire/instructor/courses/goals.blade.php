<div>

    @if(count($goals))
    <ul class=" space-y-2 mb-4" id="goals">
        @foreach ($goals as $index=> $goal)
        <li wire:key="goal-{{$goal['id']}}">
            <div class="flex">
                <x-input wire:model="goals.{{$index}}.name" class="flex-1 rounded-r-none" />
                <div class="border  border-l-0 border-gray-300 rounded-r divide-x-2 divide-gray-300">
                    <div class="flex items-center h-full">
                        <button class="px-2 hover:text-red-500" onclick="destroyGoal({{$goal['id']}})">
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
            <x-label>Nueva Meta</x-label>
            <x-input wire:model="name" class="w-full" palceholder="Ingrese el nombre de la meta" />
            <x-input-error for="name" />
            <div class="flex justify-end mt-4">
                <x-button>Agregar Meta</x-button>
            </div>
        </div>
    </form>

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        const goals=document.querySelector('#goals');
        const sortable=new Sortable(goals,{
            animation:150,
            ghostClass:'blue-background-class'
        });
    </script>
    <script>
        function destroyGoal(id){
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
  text: "La meta ha sido eliminada con éxito.",
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