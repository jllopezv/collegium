<div>
    @foreach($permissiongroups as $group)
                <table class='mb-4'>
                    <thead>
                        <tr>
                            <th class='text-left w-80'><span class='font-bold text-green-400'>{{ $group->group }}</span></th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-table'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>ACCESO</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-plus text-cool-gray-600'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>CREAR</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-eye text-cool-gray-600'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>VER</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-eye text-cool-gray-400'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>VER SOLO PROPIOS</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-edit text-cool-gray-600'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>EDITAR</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-edit text-cool-gray-400'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>EDITAR</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-trash text-cool-gray-600'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>BORRAR</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-trash text-cool-gray-400'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>BORRAR SOLO PROPIOS</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-print text-cool-gray-600'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>IMPRIMIR</span>
                                </div>
                            </th>
                            <th class='text-left'>
                                <div class='tooltip cursor-pointer font-bold  mx-2'>
                                    <i class='fa fa-print text-cool-gray-400'></i>
                                    <span class='tooltiptext tooltiptext-up-left'>IMPRIMIR SOLO PROPIOS</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">

                            @php
                                $permissions=\App\Models\Auth\Permission::active()->where('group',$group->id)->get();
                                $tables=\App\Models\Auth\Permission::getTablesFromCollection($permissions);
                            @endphp

                            @foreach($tables as $table)
                                <tr>
                                    <td >
                                        <span class='font-bold'>{{ mb_strtoupper(trans('lopsoft.tables.'.$table)) }}</span>
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.access')->first();
                                        @endphp
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                            <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                class="form-checkbox cursor-pointer h-5 w-5 text-green-400
                                                        hover:shadow-none hover:border-gray-500
                                                        active:shadow-none
                                                        focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='fa fa-ban text-red-500'></i>
                                        @endhasAbility
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.create')->first();
                                        @endphp
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                            <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                class="form-checkbox cursor-pointer h-5 w-5 text-green-400
                                                        hover:shadow-none hover:border-gray-500
                                                        active:shadow-none
                                                        focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='fa fa-ban text-red-500'></i>
                                        @endhasAbility
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.show')->first();
                                        @endphp
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                            <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                class="form-checkbox cursor-pointer h-5 w-5 text-green-400
                                                        hover:shadow-none hover:border-gray-500
                                                        active:shadow-none
                                                        focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='fa fa-ban text-red-500'></i>
                                        @endhasAbility
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.show.owner')->first();
                                        @endphp
                                        @if(!is_null($permission))
                                        <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                            class="form-checkbox cursor-pointer h-5 w-5 text-green-300
                                                    hover:shadow-none hover:border-gray-500
                                                    active:shadow-none
                                                    focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                        @endif
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.edit')->first();
                                        @endphp
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                            <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                class="form-checkbox cursor-pointer h-5 w-5 text-green-400
                                                        hover:shadow-none hover:border-gray-500
                                                        active:shadow-none
                                                        focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='fa fa-ban text-red-500'></i>
                                        @endhasAbility
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.edit.owner')->first();
                                        @endphp
                                        @if(!is_null($permission))
                                        <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                            class="form-checkbox cursor-pointer h-5 w-5 text-green-300
                                                    hover:shadow-none hover:border-gray-500
                                                    active:shadow-none
                                                    focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                        @endif
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.destroy')->first();
                                        @endphp
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                            <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                class="form-checkbox cursor-pointer h-5 w-5 text-green-400
                                                        hover:shadow-none hover:border-gray-500
                                                        active:shadow-none
                                                        focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='fa fa-ban text-red-500'></i>
                                        @endhasAbility
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.destroy.owner')->first();
                                        @endphp
                                        @if(!is_null($permission))
                                        <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                            class="form-checkbox cursor-pointer h-5 w-5 text-green-300
                                                    hover:shadow-none hover:border-gray-500
                                                    active:shadow-none
                                                    focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                        @endif
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.print')->first();
                                        @endphp
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                            <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                class="form-checkbox cursor-pointer h-5 w-5 text-green-400
                                                        hover:shadow-none  hover:border-gray-500
                                                        active:shadow-none
                                                        focus:shadow-none  focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='fa fa-ban text-red-500'></i>
                                        @endhasAbility
                                    </td>
                                    <td class='text-center'>
                                        @php
                                            $permission=$permissions->where('slug',$table.'.print.owner')->first();
                                        @endphp
                                        @if(!is_null($permission))
                                        <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                            class="form-checkbox cursor-pointer h-5 w-5 text-green-300
                                                    hover:shadow-none hover:border-gray-500
                                                    active:shadow-none
                                                    focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan='10' class='border-b-2 border-cool-gray-200 pb-3'></td>
                            </tr>
                    </tbody>
                </table>
            @endforeach
</div>
