<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\PermissionGroup;
use App\Http\Controllers\Traits\HasCommon;

class PermissionGroupController extends Controller
{

    use HasCommon;

    protected $table='permission_groups';
    protected $module='auth';
    protected $model=PermissionGroup::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=mb_strtoupper(__('lopsoft.permission_group'));
        $this->subtitle='Permite agrupar los permisos para una mejor visualización.';
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
