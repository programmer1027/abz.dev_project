
    <h1 class="text-center text-primary">{{isset($employees)?'Редактирование':'Добавление'}} сотрудника</h1>
    <hr/>
    @if(isset($employees))
        {!! Form::model($employees,['method'=>'put','id'=>'frm']) !!}
    @else
        {!! Form::open(['id'=>'frm']) !!}
    @endif
<div class="row">
    <div class="col-xs-6 col-md-4">
        @if(isset($employees))
            <img src="{{asset($employees->image)}}" alt="{{$employees->name}}">
        @endif
        <label class="btn btn-default"> {!! Form::file('image', ["class"=>"btn btn-default btn-file"]) !!}</label>
    </div>
    <div class="col-xs-6 col-md-6">
        <div class="form-group row required">
            {!! Form::label("Ф.И.О","Ф.И.О",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("name",null,["class"=>"form-control".($errors->has('name')?" is-invalid":""),"autofocus",'placeholder'=>'name']) !!}
                <span id="error-title" class="invalid-feedback"></span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("Должность","Должность",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                <select class="form-control" id="chief_id">
                    @foreach($chief as $chif)
                        <option>{{$chif->position}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3 col-lg-2"></div>
            <div class="col-md-4">
                <a href="javascript:ajaxLoad('{{url('ajaxemployees')}}')" class="btn btn-danger btn-xs">
                    Back</a>
                {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
