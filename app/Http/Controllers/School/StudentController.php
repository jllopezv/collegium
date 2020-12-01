<?php

namespace App\Http\Controllers\School;

use App\Models\School\Student;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;


class StudentController extends Controller
{
    use HasCommon;

    protected $table='students';
    protected $module='school';
    protected $model=Student::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=mb_strtoupper(__('lopsoft.tables.students'));
        $this->subtitle='Datos del estudiante';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ($this->commonIndex($options??[]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ($this->commonCreate($options??[]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ($this->commonShow($id, $options??[]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ($this->commonEdit($id, $options??[]));
    }
}
