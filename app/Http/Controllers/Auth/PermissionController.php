<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;

class PermissionController extends Controller
{

    use HasCommon;

    protected $table='permissions';
    protected $module='auth';
    protected $model=Permission::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=mb_strtoupper(__('lopsoft.permissions'));
        $this->subtitle='Cada permiso define una acción que puede ser realizada por un usuario.';
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
