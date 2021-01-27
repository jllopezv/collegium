<?php

namespace App\Http\Controllers\Aux;

use App\Models\Aux\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;

class ImageController extends Controller
{
    use HasCommon;

    protected $table='images';
    protected $module='aux';
    protected $model=Image::class;
    protected $title;
    protected $subtitle;


    public function __construct()
    {
        $this->title=transup('tables.'.$this->table);
        $this->subtitle='Imágenes usadas en distintos registros';
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
    public function edit($id, Request $request)
    {
        //dd($request->all());
        $options=[];
        if ($request->has('callback_cancel'))
        {
            $options['callback']=$request->callback_cancel;
            $options['paramscallback']=$request->callback_cancel_params;
        }
        if ($request->has('callback_success'))
        {
            $options['callforward']=$request->callback_success;
            $options['paramscallforward']=$request->callback_success_params;
        }
        return ($this->commonEdit($id, $options??[]));
    }

}
