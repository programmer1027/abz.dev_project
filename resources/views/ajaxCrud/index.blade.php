<div class="container">

    <h3 style="text-align: center">AJAX CRUD for Employees</h3>
    {{--*** Блок поиска на сайте по табице Employees ***--}}
    <div class="row">
        <div class="col-sm-6 col-md-4 pull-right">
            <div class="input-group">
                <input class="form-control" id="search"
                       value="{{ request()->session()->get('search') }}"
                       onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('ajaxemployees')}}?search='+this.value)"
                       placeholder="Поиск сотрудников..." name="search"
                       type="text" id="search"/>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-info"
                            onclick="ajaxLoad('{{url('ajaxemployees')}}?search='+$('#search').val())">
                        <i class="glyphicon glyphicon-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- ********************************************** --}}
    <br />

    <table class="table">
        <thead>
        <tr>

            <th width="60px">Фото</th>
            <th><a href="javascript:ajaxLoad('{{url('ajaxemployees?page='.(request()->session()->get('page')).'&field=name&sort='
            .(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">Ф. И. О</a>
                {{request()->session()->get('field')=='name'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>

            <th style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url('ajaxemployees?page='.(request()->session()->get('page')).'&field=position&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">
                    Должность
                </a>
                {{request()->session()->get('field')=='position'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>

            <th style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url('ajaxemployees?page='.(request()->session()->get('page')).'&field=date&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">
                    Дата приема
                </a>
                {{request()->session()->get('field')=='date'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>

            <th style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url('ajaxemployees?page='.(request()->session()->get('page')).'&field=salary&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">
                    Зарплата
                </a>
                {{request()->session()->get('field')=='salary'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>
            <th width="160px" style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url('ajaxemployees/create')}}')"
                   class="btn btn-primary btn-xs"> <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Добавить</a>
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach ($employees as $empl)
            <tr>
                <th><img src="{{asset($empl->image)}}" class="img-rounded" alt="{{$empl->name}}" width="32" height="32"></th>
                <td>{{ $empl->name }}</td>
                <td >{{ $empl->position }}</td>
                <td>{{ $empl->date }}</td>
                <td>{{ $empl->salary }}</td>
                <td>
                    <a class="btn btn-success btn-xs" title="Show"
                       href="javascript:ajaxLoad('{{url('ajaxemployees/show/'.$empl->id)}}')">
                       <b class="glyphicon glyphicon-eye-open"></b>
                    </a>
                    &nbsp;
                    <a class="btn btn-warning btn-xs" title="Edit"
                       href="javascript:ajaxLoad('{{url('ajaxemployees/edit/'.$empl->id)}}')">
                       <b class="glyphicon glyphicon-edit"></b>
                    </a>
                    &nbsp;
                    <input type="hidden" name="_method" value="delete"/>
                    <a class="btn btn-danger btn-xs" title="Delete"
                       href="javascript:if(confirm('Вы хотите удалить сотрудника?')) ajaxDelete('{{url('ajaxemployees/delete/'.$empl->id)}}','{{csrf_token()}}')">
                       <b class="glyphicon glyphicon-trash"></b>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $employees->links()}}
        </div>