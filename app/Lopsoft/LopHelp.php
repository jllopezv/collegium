<?php

namespace App\Lopsoft;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class LopHelp
{
    static public function getCommonOptionsIndexSlaveComponents($table, $model, $title, $subtitle)
    {
        return [
            'table'             =>  $table,
            'model'             =>  $model,
            'mode'              =>  'index',
            'canadd'            =>  'false',
            'canselect'         =>  'false',
            'actioncandelete'   =>  'false',
            'showactions'       =>  'true',
            'slave'             =>  'true',
            'title'             =>  $title,
            'subtitle'          =>  $subtitle,
        ];
    }


    static public function getLinkToView($table, $model, $item, $id)
    {
        if (Auth::user()->hasAbility($table.'.show'))
        {
            // Can show
            if ( $item->created_by!=Auth::user()->id && Auth::user()->hasAbility($table.'.show.owner') ) return '';
            return route($table.'.show',$id);
        }
        return '';

    }

    /************************************************/
    /* ROUTES                                       */
    /************************************************/

    static public function generateCommonModelRoute($table, $controllerclass, $model)
    {
        Route::get($table,                    [ $controllerclass, 'index'     ])->middleware('permission:'.$table.'.access')->name($table.'.index');
        Route::get($table.'/create',          [ $controllerclass, 'create'    ])->middleware('permission:'.$table.'.create')->name($table.'.create');
        Route::get($table.'/edit/{id}',       [ $controllerclass, 'edit'      ])->middleware('permission:'.$table.'.edit')->middleware('allowaction:'.$model.',edit')->name($table.'.edit');
        Route::get($table.'/{id}',            [ $controllerclass, 'show'      ])->middleware('permission:'.$table.'.show')->middleware('allowaction:'.$model.',show')->name($table.'.show');
    }


    /***********************************************/
    /* DROPDOWNS OPTIONS                           */
    /***********************************************/

    static public function getDateFormatsDropDown()
    {
        return
        [
            [ 'value' => 'd/m/Y', 'text' => "dd/mm/yyyy" ],
            [ 'value' => 'm/d/Y', 'text' => "mm/dd/yyyy" ],
            [ 'value' => 'Y-m-d', 'text' => "yyyy-mm-dd" ],
            [ 'value' => 'Y/m/d', 'text' => "yyyy/mm/dd" ],
            [ 'value' => 'Y.m.d', 'text' => "yyyy.mm.dd" ],
        ];
    }

    static public function getSexDropDown()
    {
        return
        [
            [ 'value' => 'M', 'text' => transup('male') ],
            [ 'value' => 'F', 'text' => transup('female') ],
        ];
    }

    static public function getAppSettingTypesDropDown()
    {
        return
        [
            [ 'value' => 'text',    'text' => "<i class='text-cool-gray-400 fa fa-keyboard fa-fw'></i> TEXTO" ],
            [ 'value' => 'number', 'text' => "<i class='text-green-300 fa fa-calculator fa-fw'></i>  NÚMERO" ],
            [ 'value' => 'boolean', 'text' => "<i class='text-blue-400 fa fa-toggle-on fa-fw'></i> SI/NO" ],
            [ 'value' => 'image',   'text' => "<i class='text-orange-300 fa fa-image fa-fw'></i> IMAGEN" ],
        ];
    }

    static public function getFilterDropDown($model, $key, $value, $filterraw, $hasall,$orderraw)
    {
        $query=$model::query();
        if ($filterraw!="") $query->whereRaw($filterraw);
        if ($orderraw!="") $query->orderByRaw($orderraw);
        $records=$query->get();
        $ret=[];
        if ($hasall)
        {
            $ret[] = [ 'value' => '*', 'text' => 'TODOS' ];
        }
        foreach($records as $record)
        {
            $ret[] = [ 'value' => $record[$key], 'text' => $record[$value] ];
        }
        return $ret;
    }


}
