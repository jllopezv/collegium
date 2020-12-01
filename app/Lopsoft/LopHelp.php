<?php

namespace App\Lopsoft;

use Illuminate\Support\Facades\Auth;
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
        ];
    }
}
