<?php

namespace App\Http\Controllers\School;

use App\Models\School\SchoolLevel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;

class SchoolLevelController extends Controller
{
    use HasCommon;

    protected $table='school_levels';
    protected $module='school';
    protected $model=SchoolLevel::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=transup('tables.'.$this->table);
        $this->subtitle='Nivel académico';
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
