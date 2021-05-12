<div class='py-4 overflow-x-auto '>
    <div class='max-w-xl px-2 py-4 mx-auto'>
        @foreach($permissiongroups as $group)
            <div class='my-2'>
                <div class='inline-flex items-center justify-start'>
                    <div class='w-48 text-left border-b-2 border-gray-400'>
                        <span class='font-bold text-green-400'>{{ $group->group }}</span>
                    </div>
                    @if($group->group!='ESPECIALES')
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-table'></i>
                            <span class='tooltiptext tooltiptext-center-left'>ACCESO</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-plus text-cool-gray-600'></i>
                            <span class='tooltiptext tooltiptext-center-left'>CREAR</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-eye text-cool-gray-600'></i>
                            <span class='tooltiptext tooltiptext-center-left'>VER</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-eye text-cool-gray-400'></i>
                            <span class='tooltiptext tooltiptext-center-left'>VER SOLO PROPIOS</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-edit text-cool-gray-600'></i>
                            <span class='tooltiptext tooltiptext-center-left'>EDITAR</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-edit text-cool-gray-400'></i>
                            <span class='tooltiptext tooltiptext-center-left'>EDITAR SOLO PROPIOS</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-trash text-cool-gray-600'></i>
                            <span class='tooltiptext tooltiptext-center-left'>BORRAR</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-trash text-cool-gray-400'></i>
                            <span class='tooltiptext tooltiptext-center-left'>BORRAR SOLO PROPIOS</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-lock text-cool-gray-600'></i>
                            <span class='tooltiptext tooltiptext-center-left'>BLOQUEAR</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-lock text-cool-gray-400'></i>
                            <span class='tooltiptext tooltiptext-center-left'>BLOQUEAR SOLO PROPIOS</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-print text-cool-gray-600'></i>
                            <span class='tooltiptext tooltiptext-center-left'>IMPRIMIR</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-print text-cool-gray-400'></i>
                            <span class='tooltiptext tooltiptext-center-left'>IMPRIMIR SOLO PROPIOS</span>
                        </div>
                    @else
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-sign-in'></i>
                            <span class='tooltiptext tooltiptext-center-left'>LOGIN</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-calendar'></i>
                            <span class='tooltiptext tooltiptext-center-left'>CAMBIAR SESIÓN</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-cogs'></i>
                            <span class='tooltiptext tooltiptext-center-left'>CONFIGURACIÓN</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-calendar-check'></i>
                            <span class='tooltiptext tooltiptext-center-left'>ACTIVAR / DESACTIVAR EN EL AÑO ACADÉMICO</span>
                        </div>
                        <div class='w-8 font-bold text-center border-b-2 border-gray-400 cursor-pointer tooltip'>
                            <i class='fa fa-sort-numeric-up'></i>
                            <span class='tooltiptext tooltiptext-center-left'>PERMITIR CAMBIAR PRIORIDAD</span>
                        </div>

                    @endif
                </div>
            </div>
            <div class='pb-4'>
                @php
                    $permissions=\App\Models\Auth\Permission::active()->where('group',$group->id)->get();
                    $tables=\App\Models\Auth\Permission::getTablesFromCollection($permissions);
                @endphp
                @foreach($tables as $table)
                    <div class=''>
                        <div class='inline-flex items-center justify-start'>
                            <div class='w-48 pt-1'>
                                <span class='font-bold'>{{ transup('tables.'.$table) }}</span>
                            </div>
                            @if($group->group!='ESPECIALES')
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.access')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if( !is_null($permission) )

                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500"
                                                    @if($mode=='show')
                                                        disabled
                                                    @endif/>

                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.create')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>

                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility

                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.show')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.show.owner')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-300 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.edit')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.edit.owner')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-300 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.destroy')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.destroy.owner')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-300 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.lock')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.lock.owner')->first();
                                    @endphp
                                    @if( !is_null($permission) )
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-300 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.print')->first();
                                    @endphp
                                    @if(!is_null($permission))
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.print.owner')->first();
                                    @endphp
                                    @if(!is_null($permission))
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-green-300 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                            @else
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.login')->first();
                                    @endphp
                                    @if(!is_null($permission))
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-blue-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.changeannosession')->first();
                                    @endphp
                                    @if(!is_null($permission))
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-blue-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.settings')->first();
                                    @endphp
                                    @if(!is_null($permission))
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-blue-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.activateanno')->first();
                                    @endphp
                                    @if(!is_null($permission))
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-blue-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                                <div class='w-8 text-center'>
                                    @php
                                        $permission=$permissions->where('slug',$table.'.changepriority')->first();
                                    @endphp
                                    @if(!is_null($permission))
                                        @hasAbility($permission->slug)
                                            @if(!is_null($permission))
                                                <input type='checkbox' wire:model='permissionsselected' name='permission_{{ $permission->id }}' value='{{ $permission->id }}'
                                                    class="w-5 h-5 text-blue-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500" @if($mode=='show') disabled @endif/>
                                            @endif
                                        @else
                                            <i class='text-red-500 fa fa-ban'></i>
                                        @endhasAbility
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach


    </div>
</div>
