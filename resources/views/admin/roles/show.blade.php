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
'name'=>$role->name,

],

]">



</x-admin-layout>