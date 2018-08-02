<h1 class="text-center text-primary">Добавление сотрудника</h1>
<hr/>
    {!! Form::open(['id'=>'frm']) !!}
<div class="row">
    <div class="col-xs-6 col-md-4 center-block">
        <b style="margin-left: 20px">Загрузите изображение</b>
        <span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span>
        <div class="anyName">
            <input type="file" name="image" id="img" accept="image/gif, image/jpeg, image/png" required="required">
        </div>
    </div>
    <div class="col-xs-6 col-md-6">
        <table class="table">
            <tr>
                <td class="form-group row required">
                    Ф.И.О.<span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span>
                </td>
                <td>
                    <input name="name" type="text" class="form-control" placeholder="Введите имя" value="" required>
                </td>
            </tr>
            <tr>
                <td>
                    Должность <span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span>
                </td>
                <td>
                  <select class="form-control" name="position_id" id="position" required="required">
                    @foreach($position as $pos)
                        <option name="pos" id="{{$pos->id}}" value="{{$pos->id}}">{{$pos->position}}</option>
                      @endforeach
                  </select>
                </td>
            </tr>
            <tr>
                <td>
                    Дата приема
                    <span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span>
                </td>
                <td>
                    <div class="form-group">
                       <input type="date" name="date" class="form-control" required="required">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    Начальник
                    <span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span>
                </td>
                <td>
                    {!! Form::select('parent_id',[''=>'--- Начальник ---'],null,['class'=>'form-control']) !!}
                </td>
            </tr>
        </table>
        <div class="col-md-4">
            <a href="javascript:ajaxLoad('{{url('ajaxemployees')}}')" class="btn btn-danger btn-xs">
                Назад</a>
            <button type="submit" class="btn btn-primary btn-xs" name="submit" id="submit1">Сохранить</button>
        </div>
    </div>

    {!! Form::close() !!}
</div>
<script type="text/javascript">
    $('.anyName').uploadPreview({
        width: '200px',
        height: '200px',
        backgroundSize: 'cover',
        fontSize: '16px',
        borderRadius: '100px',
        border: '3px solid #dedede',
        lang: 'ru', //language
    });
</script>
