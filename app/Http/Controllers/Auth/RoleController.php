<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\Role;
use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;
use App\Models\Auth\PermissionGroup;

class RoleController extends Controller
{

    use HasCommon;


    protected $table='roles';
    protected $module='auth';
    protected $model=Role::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=mb_strtoupper(__('lopsoft.roles'));
        $this->subtitle='El rol es el tipo de cada usuario. En el rol se definen que permisos tendrá el usuario y el nivel de autorización.';
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
        $options=[
            'permissions'       =>  Permission::active()->get(),
            'permissiongroups'  =>  PermissionGroup::active()->orderBy('priority')->orderBy('group')->get(),
        ];
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
