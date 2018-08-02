@extends('layout.master')

@section('content')
    <h3 style="text-align: center">Список сотрудников фирмы</h3>
    {{--*** Блок поиска на сайте по табице Employees ***--}}
        <div class="row">
            <form action="{{action('EmployeesController@index')}}" method="get">
                <div class="col-sm-6 col-md-4 pull-right">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Поиск...">
                        <input type="hidden" value="{{request('field')}}" name="field"/>
                        <input type="hidden" value="{{request('sort')}}" name="sort"/>
                        <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </form>
        </div>
    {{-- ********************************************** --}}
    <br />
    {{-- Отоброжаем таблицу всех сотрудников с возможностью сортировки по полям --}}
    <table class="table">
        <thead>
        <tr class="info">
            {{-- Реализуем сортировки по полям: ID, NAME, Position, DATE, Salary --}}
            <th scope="col">
                {{-- Сортировка по полю ID. Работает по умолчанию --}}
                 <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=id&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">ID</a>
                {{request('field','id')=='id'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>
            <th scope="col">
                {{-- Сортировка по полю NAME.--}}
                <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=name&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">Ф.И.О.</a>
                {{request('field','name')=='name'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>
            <th scope="col">
                {{-- Сортировка по полю Position(Должность).--}}
                <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=position&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">Должность</a>
                {{request('field','position')=='position'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>
            <th scope="col">
                {{-- Сортировка по полю Date(Дата приема).--}}
                <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=date&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">Дата приема</a>
                {{request('field','date')=='date'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>
            <th scope="col">
                {{-- Сортировка по полю Salary(Уровень заработной платы).--}}
                <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=salary&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                Уровень ЗП <i class="glyphicon glyphicon-ruble"></i></a>
                {{request('field','salary')=='salary'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($employees as $empl)
        <tr>
            <th scope="row">{{ $empl->id }}</th>
            <td>{{ $empl->name }}</td>
            <td>{{ $empl->position }}</td>
            <td>{{ $empl->date }}</td>
            <td>{{ $empl->salary }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{-- ..... Постраничная навигация ..... --}}
    <nav aria-label="Page navigation" class="text-center">
        {{ $employees->appends(array('search' => request('search'), 'sort' => request('sort'), 'field' => request('field')))->links() }}
       {{-- @else {{ $employees->links() }} --}}

    </nav>

@endsection