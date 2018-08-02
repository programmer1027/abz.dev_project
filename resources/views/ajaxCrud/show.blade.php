<h2 class="text-center text-primary">Информация о сотруднике</h2>
<div class="row">
    @foreach($employees as $empl)
        <div class="col-xs-6 col-md-4">
            <img src="{{asset($empl->image)}}" alt="{{$empl->name}}" width="350" height="400">
        </div>

        <div class="col-xs-6 col-md-6">
            <h3 class="my-3">{{$empl->name}}</h3>
            <table class="table">
                <tr>
                    <td>Должность</td>
                    <td>{{$empl->position}}</td>
                </tr>
                <tr>
                    <td>Дата приема</td>
                    <td>{{$empl->date}}</td>
                </tr>
                <tr>
                    <td>Зарплата</td>
                    <td>{{$empl->salary}} руб.</td>
                </tr>
            </table>

            <h4 class="my-3">Начальник сотрудника</h4>
            <table class="table">
                <tr>
                    <td>Ф.И.О</td>
                    <td>{{$empl->chiefName}}</td>
                </tr>
                <tr>
                    <td>Должность</td>
                    <td>{{$empl->chiefPosition}}</td>
                </tr>
            </table>
            <div class="col-md-4">
                <a href="javascript:ajaxLoad('{{url('ajaxemployees')}}')" class="btn btn-danger btn-xs">
                    Назад</a>
            </div>
        </div>
    @endforeach
</div>

