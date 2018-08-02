<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class Employees extends Model
{
    protected $table = 'employees'; //Наша таблица в БД
    protected $fillable = ['parent_id', 'position_id', 'name', 'date', 'image'];//Указывает, какие поля должны быть доступны при массовом заполнении.
    public $timestamps = false;


    public function childs()
    {
       return $this->hasMany('App\Employees', 'parent_id', 'id');
    }

    /** Выбераем все записи из таблицы employees, связываем стаблицей должностей  */

   static public function getEmployeesAll()
    {
        return
            DB::table('employees')
                ->leftJoin('position', function ($query) {
                    $query->on('position.id', '=', 'employees.position_id');
                })
                ->select('employees.*', DB::raw('position.position as position, position.salary as salary'))
                ->orderBy('position', 'asc')
                ->get();
    }

    /** Выборка всех сотрудников с сортировками, и поиском.
     * Для страниц "employees" и "ajaxemployees"
     */
    static public function getEmployees($order = "asc", $name = "id", $search="")
    {
       return
           DB::table('employees')
                ->where("name", "like","%".$search."%")
                ->orWhere("position", "like","%".$search."%")
                ->orWhere("date", "like","%".$search."%")
                ->orWhere("salary", "like","%".$search."%")
                ->leftJoin('position', function ($query) {
                    $query->on('position.id', '=', 'employees.position_id');
                })
                ->select('employees.*', DB::raw('position.position as position, position.salary as salary'))
                ->orderBy($name, $order)
                ->paginate(30);
    }

    /** Выбираем конкретного сотрудника по ID, CRUD AJAX для страницы  "ajaxemployees".
     * Определяем в запросе имя и должность началька chiefName(Имя начальника), chiefPosition(Должность нач.)
     */
    static public function getEmployeesID($id)
    {
        return
            DB::select('select name, date, image, position, salary,
                (select name from employees b where a.parent_id = b.id) chiefName,
                (select position from employees d
                left join position c ON
                c.id = d.position_id where a.parent_id = d.id) chiefPosition
                from employees a
                left join position c
                    ON c.id = a.position_id
                where a.id = :id', ['id' => $id]);
    }
    /** Выбираем начальников для сотрудника при добавлении
     *Выбираем только тех сотрудников где переданный уровень позиции выше.
     */
    static public function getChiefs($id){
        return
            DB::table('employees')->where('position_id', '<', $id)->pluck("name", "id")->all();
    }


}