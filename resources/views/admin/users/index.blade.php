<x-admin-layout :breadcrumb="[
[
  'name'=>'Dashboard',
  'url'=>route('admin.dashboard')

],
[
'name'=>'Usuarios',


]
]">
  @livewire('user-table')

</x-admin-layout>