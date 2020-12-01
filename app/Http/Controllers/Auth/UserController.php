<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;

class UserController extends Controller
{

    use HasCommon;

    protected $table='users';
    protected $module='auth';
    protected $model=User::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=mb_strtoupper(__('lopsoft.users'));
        $this->subtitle='Selección de usuarios con acceso al area privada.';
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
