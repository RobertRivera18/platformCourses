<div>
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
        
        }" x-init="new Sortable($refs.sections,{
            animation:150,
            handle:'.handle',
            ghostClass:'blue-background-class',
            store:{
                set:(sortable)=>{
                   @this.call('sortSections', sortable.toArray())
                }
            }
        });">
            {{-- Listar secciones --}}
            @if($sections->count())
            
            <ul class="mb-6 space-y-6" x-ref="sections">
        
                @foreach($sections as $section)
              
                <li data-id="{{$section->id}}" wire:key="section-{{$section->id}}">
                 @include('instructor.sections.create-position')
            
                    <div class="bg-gray-100 rounded-lg shadow-lg px-6 py-4">
        
                        @if ($sectionEdit['id']==$section->id)
                        @include('instructor.sections.edit')
                        @else
                        @include('instructor.sections.show')
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
            @endif
        
            <div x-data="{
            open:false
            }">
                <div x-on:click="open = !open"
                    class="h-6 w-12 -ml-4 bg-indigo-50 hover:bg-indigo-200 flex items-center justify-center cursor-pointer"
                    style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">
        
                    <i class="-ml-2 text-sm fas fa-plus transition duration-300" :class="{
                                'transform rotate-45': open,
                                'transform rotate-0': !open
                            }"></i>
                </div>
                {{-- Crear secciones --}}
        
                <div x-show="open" x-cloak class="mt-4">
                    <form wire:submit="store">
                        <div class="bg-gray-100 rounded-lg shadow-lg p-6 mt-6">
                            <x-label>Nueva sección</x-label>
                            <x-input wire:model="name" class="w-full" palceholder="Ingrese el nombre de la sección" />
                            <x-input-error for="name" />
                            <div class="flex justify-end mt-4">
                                <x-button>Agregar Sección</x-button>
                            </div>
                        </div>
                    </form>
        
                </div>
        
            </div>
        </div>
        @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
        @endpush
</div>