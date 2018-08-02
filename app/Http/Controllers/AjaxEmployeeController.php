<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Employees;
use App\Position;

class AjaxEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('search', $request
                ->has('search') ? $request->get('search') : ($request->session()
                ->has('search') ? $request->session()->get('search', '') : ""));
            $request->session()->put('field', $request
                ->has('field') ? $request->get('field') : ($request->session()
                ->has('field') ? $request->session()->get('field') : 'name'));
                $request->session()->put('sort', $request
                    ->has('sort') ? $request->get('sort') : ($request->session()
                    ->has('sort') ? $request->session()->get('sort') : 'asc'));

        /** Выбираем всех сотрудников из таблицы employees,
         * и подставляем данные переданные через AJAX
         */
        $employees = Employees::getEmployees($request->session()->get('sort'),
                     $request->session()->get('field'), $request->session()->get('search'));

        if ($request->ajax()) {//Если были переданны по средствам ajax, передаем данные с параметрами сотрировки или поиска
            return view('ajaxCrud.index', compact('employees'));
        } else {               //Иначе отправляем данные с параметрами по умолчанию при авторизации
            return view('ajaxCrud.ajax', compact('employees'));
        }
    }


    /**
     *Добовляем нового сотрудника в базу данных
     */
    public function create(Request $request)
    {
        if ($request->isMethod('get')){
            $position = Position::all(); //Выбираем все должности для острудника
            //Передаем виду create и отображаем select-ом для выбоара должности нанимаегого сотрудника
            return view('ajaxCrud.create', compact('position'));
        }
        //Правило для полей при отправке формы, для добавления
        //инфо о сотруднике, В случае не соответствия вернем ошибку.
        $this->validate($request, [
            'name' => 'required|max:100', //Проверка ФИО работника
            'parent_id' => 'required||regex:/^[1-9]+$/i',//Проверка на начальника, передается число
            'position_id' => 'required||regex:/^[0-9]+$/i',//Проверка на должность, предается число.
            'date' => 'required||regex:/^\d{4}-\d{2}-\d{2}/' //Дата приема в формате YYYY-MM-DD
        ]);
        if($request->hasFile('image')){//Если передано изображение
            $f_name=$request->file('image')->getClientOriginalName();//определяем имя файла
            $root = public_path('img'); // это корневая папка для загрузки картинок
            $request->file('image')->move($root, $f_name); //перемещаем файл в папку с оригинальным именем
            $all=$request->all(); //в переменой $all будет массив, который содержит все введенные данные в форме
            $all['image']="/img/".$f_name;// меняем значение image на нашу ссылку, иначе в базу попадет что-то вроде /tmp/adfEEsf.tmp
            Employees::create($all);
        }
    }

    public function show(Request $request, $id)
    {
        /**
         *Метод show принимает значение ID конкретного сотрудника
         * Функция getEmployeesID делаем выборку по конкретному сотруднику с нужным id
         * возвращает массив сотрудников с нужным ID. При этом отображает начальника сотрудника
         * его ФИО и занимаемую должность.
         */
        if($request->isMethod('get')) {
            $employees = Employees::getEmployeesID($id);
            return view('ajaxCrud.show',['employees' => $employees]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get')){
            $employees = Employees::getEmployeesID($id);
            $position = Position::all();
            return view('ajaxCrud.edit',['employees' => $employees, 'position' => $position, 'id' => $id]);
        }
        if($request->isMethod('put')){
             $employees = Employees::find($request->id);
             $employees->name = $request->name; //Сохраняем имя.

             if(isset($request->position_id)){
                 $employees->position_id = $request->position_id;//Сохраняем должность
                 $employees->position_id = $request->parent_id;//Сохраняем Начальника для сотрудника
             }
             if($request->hasFile('image')){//Если передано изображение
                $f_name=$request->file('image')->getClientOriginalName();//определяем имя файла
                $root = public_path('img'); // это корневая папка для загрузки картинок
                $request->file('image')->move($root, $f_name); //перемещаем файл в папку с оригинальным именем
                $employees->image="/img/".$f_name;// меняем значение image на нашу ссылку, иначе в базу попадет что-то вроде /tmp/adfEEsf.tmp
            }
            $employees->save();//Сохраняем отредактированную инфу в базу
             return response()->json([
                       'fail' => false,
                       'redirect_url' => url('ajaxemployees')
                   ]);
        }
    }



    /**
     * Метод удаления сотрудника из базы. Нужно учесть что у сотрудника могут быть подчененные
     * у которых parent_id указывает на удаляющегося сотрудника.
     * В таком случае необходимо предусмотреть перераспределение подчинённых новому руководителю.
     */
    public function destroy($id)
    {
        //Выбираем всех сотрудников где parent_id = id; Всех подчененных если они есть у сотрудника
        $employees_parent = Employees::where('parent_id', '=', $id)->get();
        $data = Employees::find($id);//Выбираем конкретного сотрудника которого будем удалять
        if(count($employees_parent) == 0){
            //Если у сотрудника нет подчиненных то просто удаляем его из базы
            Employees::destroy($id);
        }
        //Если ужаляем ген. директора. То необходимо назначить другого работника на его должность
        elseif ($data->position_id == 1)
        {
            //Выбираем сотрудника из базы который ниже по рангу на 1 уровень.
            $employees = Employees::where('position_id', '=', $data->position_id + 1)->first();
            Employees::where('id', '=', $employees->id)->update(["position_id" => 1, "parent_id" => 0]);
            //Модифицируем сылку на нового начальника(parent_id)
            Employees::where('parent_id', $id)->update(['parent_id' => $employees->id]);
            Employees::destroy($id);//Удаляем из базы предыдущего ген. директора
        }
        else
        {
            //Необходимо определить начальника сотрудника которому будут переданы подчиненные
            //Передаем всех подченненных начальнику удаляемого сотрудника.
            $parent_id = $data->parent_id;//Определяем его начальника
            //Переносим всех сотрудников к новому начальнику.
            Employees::where('parent_id', '=', $id)->update(["parent_id" => $parent_id]);
            //Удаляем выбраного сотрудника из базы данных
            Employees::destroy($id);
        }
        return redirect('ajaxemployees'); //Возвращаемся к списку сотрудников.
    }

    //Метод change нужен для select-а при добавлении сотрудника
    //Данные аередаются через ajax.
    //Выбрав должность ему предлагается выбрать начальника
    //Ранг начальника должен быть выше.
    public function change(Request $request){
        if ($request->isMethod('get')){
            $id = $request->id; // ID выбраной должности
            $chiefs = Employees::getChiefs($id); //Выбираепм имена всех начальников старших по должности
            $data = view('ajaxCrud.ajax-select',compact('chiefs'))->render();
            return response()->json(['options'=>$data]);
        }
    }

}
