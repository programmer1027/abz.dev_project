<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout.master');
});

//Отображаем иерархический список, дерево
Route::get('tree-view',['uses'=>'EmployeesController@tree']);
Route::resource('employees','EmployeesController');

Auth::routes();

Route::group(['prefix'=>'ajaxemployees', 'middleware' => 'auth'], function(){
    Route::get('/', 'AjaxEmployeeController@index');//Cписок всех сотрудников
    ////////////////////////
    Route::match(['get', 'put'], 'edit/{id}', 'AjaxEmployeeController@edit');//Обновляем информацию о сотруднике
    Route::match(['get', 'post'], 'create', 'AjaxEmployeeController@create'); //Добовляем сотрудника в базу
    Route::get('show/{id}', 'AjaxEmployeeController@show');//Инфо о конкретном сотруднике
    Route::delete('delete/{id}', 'AjaxEmployeeController@destroy');//Удаляем сотрудника из базы
    ////////////////////////
    Route::get('/changeselect', 'AjaxEmployeeController@change');//Изменяем select, начальник по подчененности
});


Route::group(['prefix'=>'treeviewjs', 'middleware' => 'auth'], function(){
    Route::get('/', 'AjaxTreeviewController@index');//иерархия сотрудников ajax
});

Route::get("/home", function () {
    return view('layout.master');
});