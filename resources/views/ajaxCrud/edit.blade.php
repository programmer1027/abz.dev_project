<h1 class="text-center text-primary">{{isset($employees)?'Редактирование':'Добавление'}} сотрудника</h1>
<hr/>
@if(isset($employees))
    {!! Form::model($employees,['method'=>'put','id'=>'frm']) !!}
@endif
<div class="row">
    @foreach($employees as $empl)
        {{-- Загружаем изображение --}}
        <div class="col-xs-6 col-md-4">
            <img src="{{asset($empl->image)}}" name="image" alt="{{$empl->name}}" width="350" height="400"><br><br>
            <span class="btn btn-default btn-file">
                Загрузка изображения
                <input type="file" name="image" id="img" class="form-control-file" accept="image/gif, image/jpeg, image/png">
            </span>
        </div>
        <input type="hidden" id="{{$id}}" name="empl_id">
        <div class="col-xs-6 col-md-6">
            <table class="table">
                <tr>
                    <td class="form-group row required">
                        Ф.И.О.<span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span>
                    </td>
                    <td>
                        <input name="name" type="text" class="form-control" placeholder="Ваше имя" value="{{$empl->name}}" required>
                    </td>
                </tr>
                <tr>
                    <td>Текущая должность</td>
                    <td>{{$empl->position}}</td>
                </tr>
                <tr>
                    <td>
                        Изменить должность
                        <input class="form-check-input" type="checkbox" value="" id="enableSelect">
                    </td>
                    <td>
                        <input type="hidden" name="hidenPosition" value="{{$empl->position}}">
                        <select class="form-control" name="position_id" id="position" disabled>
                            @foreach($position as $pos)
                                @if($pos->position == $empl->position)
                                    <option name="pos" selected id="{{$pos->id}}" value="{{$pos->id}}">{{$pos->position}}</option>
                                @else
                                    <option name="pos" id="{{$pos->id}}" value="{{$pos->id}}">{{$pos->position}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
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
                <tr>
                    <td>
                        Изменить начальника
                    </td>
                    <td>
                        {!! Form::select('parent_id',[''=>'--- Начальник ---'], $empl->chiefName,['class'=>'form-control', 'disabled' => true, 'id' => 'parent_id']) !!}
                    </td>
                </tr>
            </table>
            <div class="col-md-4">
                <a href="javascript:ajaxLoad('{{url('ajaxemployees')}}')" class="btn btn-danger btn-xs">
                    Назад</a>
                <button type="submit" class="btn btn-primary btn-xs" name="submit" id="submit1">Сохранить</button>
{{--  {!! Form::button("Сохранить",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!} --}}
</div>
</div>
@endforeach
        {!! Form::close() !!}
</div>
