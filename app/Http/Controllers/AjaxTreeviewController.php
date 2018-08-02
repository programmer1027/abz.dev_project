<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;

class AjaxTreeviewController extends Controller
{
    public function index(Request $request)
    {
        return view('ajaxtree.index', ['employees'=>$this->makeArray(Employees::getEmployeesAll())]);
    }

    private function makeArray($employees){
        $childs=[];

        foreach($employees as $employee){
            $childs[$employee->parent_id][]=$employee;
        }

        foreach($employees as $employee){
            if(isset($childs[$employee->id]))
                $employee->childs=$childs[$employee->id];

        }
        if(count($childs)>0){
            $tree=$childs[0];
        }
        else {
            $tree=[];
        }
        return $tree;
    }
}
