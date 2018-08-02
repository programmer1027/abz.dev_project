<ul>
    @foreach($childs as $child)
        <li>
            {{$child->name}}, Должность: {{$child->position}}, Приём: {{$child->date}}, ЗП: {{$child->salary}}
            @if(isset($child->childs))
                @include('EmployeeTreeview.tree',['childs'=>$child->childs])
            @endif
        </li>
    @endforeach
</ul>