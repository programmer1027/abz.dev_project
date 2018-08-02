<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tree()
    {
        return view('EmployeeTreeview.index',['employees'=>$this->makeArray(Employees::getEmployeesAll())]);
    }

    public function index(Request $request)
    {
        if(isset($request)) {
            $field = $request->get('field') != '' ? $request->get('field') : 'id';
            $sort = $request->get('sort') != '' ? $request->get('sort') : 'asc';
            $search = $request->get('search');
        }
        else {
            $field = "id"; $sort = "asc";
        }

        return view('employees.index', ['employees'=>Employees::getEmployees($sort, $field, $search)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
