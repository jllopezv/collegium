<?php

namespace App\Http\Controllers\Website;

use App\Models\Website\WebsitePost;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;

class WebsitePostController extends Controller
{
    use HasCommon;

    protected $table='website_posts';
    protected $module='website';
    protected $model=WebsitePost::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=transup('tables.'.$this->table);
        $this->subtitle='Artículos que aparecerán en el website';
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
