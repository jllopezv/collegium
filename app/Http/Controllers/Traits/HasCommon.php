<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

Trait HasCommon
{

    public function checkHasAbilityAccess()
    {
        if ( !(Auth::check() && Auth::user()->hasAbility($this->table.".access")) ) abort(403);
    }

    public function checkHasAbilityCreate()
    {
        if ( !(Auth::check() && Auth::user()->hasAbility($this->table.".create")) ) abort(403);
    }

    public function checkHasAbilityShow()
    {
        if ( !(Auth::check() && Auth::user()->hasAbility($this->table.".show")) ) abort(403);
    }

    public function checkHasAbilityEdit()
    {
        if ( !(Auth::check() && Auth::user()->hasAbility($this->table.".edit")) ) abort(403);
    }

    public function commonIndex($options)
    {
        $this->checkHasAbilityAccess();
        $params=[
            'title'     =>  $this->title,
            'subtitle'  =>  $this->subtitle,
            'table'     =>  $this->table,
            'model'     =>  $this->model,
        ];
        return view('models.'.$this->module.'.'.$this->table.'.index', array_merge($params,$options)); // Main view
    }

    public function commonCreate($options)
    {
        $this->checkHasAbilityCreate();
        $params=[
            'title'     =>  $this->title,
            'subtitle'  =>  $this->subtitle,
            'table'     =>  $this->table,
            'model'     =>  $this->model,
        ];
        return view('models.'.$this->module.'.'.$this->table.'.create', array_merge($params,$options)); // Create View
    }

    public function commonShow($id, $options)
    {
        if ( is_null($this->model::find($id)) ) abort(404);
        $this->checkHasAbilityShow();
        $params= [
            'title'             =>  $this->title,
            'subtitle'          =>  $this->subtitle,
            'table'             =>  $this->table,
            'model'             =>  $this->model,
            'record'            =>  $this->model::find($id),
            'recordid'          =>  $id,
        ];

        return view('models.'.$this->module.'.'.$this->table.'.show', array_merge($params,$options)); // Show View
    }

    public function commonEdit($id, $options)
    {
        if ( is_null($this->model::find($id)) ) abort(404);
        $this->checkHasAbilityEdit();
        $params= [
            'title'             =>  $this->title,
            'subtitle'          =>  $this->subtitle,
            'table'             =>  $this->table,
            'model'             =>  $this->model,
            'record'            =>  $this->model::find($id),
            'recordid'          =>  $id,
        ];
        return view('models.'.$this->module.'.'.$this->table.'.edit', array_merge($params,$options)); // Edit View
    }
}
