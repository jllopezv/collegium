<?php

namespace App\Http\Controllers\Aux;

use App\Models\Aux\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;

class CountryController extends Controller
{
    use HasCommon;

    protected $table='countries';
    protected $module='aux';
    protected $model=Country::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=mb_strtoupper(__('lopsoft.country'));
        $this->subtitle='Establece los paises y sus características';
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
