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
'name'=>'Nuevo',
],

]">

</x-admin-layout>