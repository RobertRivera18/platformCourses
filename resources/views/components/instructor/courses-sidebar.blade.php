@props(['course'])


@php
    $links=[
[ 
    'name'=>'Información del Curso',
    'url'=>route('instructor.courses.edit',$course),
    'active'=>request()->routeIs('instructor.courses.edit')
],
[ 
    'name'=>'Video Promocional',
    'url'=>route('instructor.courses.video',$course),
    'active'=>request()->routeIs('instructor.courses.video')
],
[ 
    'name'=>'Metas del Curso',
    'url'=>route('instructor.courses.goals',$course),
    'active'=>request()->routeIs('instructor.courses.goals')
],

    ]
@endphp
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 ">
        <aside class="col-span-1">
            <nav>
                <ul>
                    @foreach ($links as $link)
                    <li class="border-l-4  pl-3 {{$link['active'] ? 'border-indigo-400 pl-3' : 'border-transparent' }} ">
                        <a href="{{$link['url']}}">
                            {{$link['name']}}
                        </a>
                    </li>
                    @endforeach
                    
                    
                </ul>
            </nav>
        </aside>
        <div class="col-span-1 lg:col-span-4">
            <div class="card">
                {{$slot}}
            </div>
        </div>
    </div>