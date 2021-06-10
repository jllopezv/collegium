<?php

namespace App\Http\Controllers\Crm;

use App\Models\Crm\CustomerType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;

class CustomerTypeController extends Controller
{
    use HasCommon;

    protected $table='customer_types';
    protected $module='crm';
    protected $model=CustomerType::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=transup('tables.'.$this->table);
        $this->subtitle='Tipos de clientes';
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

