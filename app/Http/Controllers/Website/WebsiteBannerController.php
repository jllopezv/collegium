<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Website\WebsiteBanner;
use App\Http\Controllers\Traits\HasCommon;

class WebsiteBannerController extends Controller
{
    use HasCommon;

    protected $table='website_banners';
    protected $module='website';
    protected $model=WebsiteBanner::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=transup('tables.'.$this->table);
        $this->subtitle='Define las imágenes que apareceran en los banners del website';
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
