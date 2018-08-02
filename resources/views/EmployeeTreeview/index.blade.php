@extends('layout.master')

@section('content')

    <h3 style="text-align: center">Иерархия сотрудников</h3>

    <ul id="tree1">
        @foreach($employees as $empl)
            <li>
                {{$empl->name}}, Должность: {{$empl->position}}, Приём: {{$empl->date}}, ЗП: {{$empl->salary}}

                @if(isset($empl->childs))
                    @include('EmployeeTreeview.tree',["childs"=>$empl->childs])
                @endif
            </li>
        @endforeach
    </ul>
@endsection