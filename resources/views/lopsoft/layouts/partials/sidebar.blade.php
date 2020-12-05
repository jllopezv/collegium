<div
    id='sidebar'
    x-cloak
    x-show.transition.opacity.duration.500ms='showsidebar'
    x-on:click.away='if (opensidebar==true)  checkWidth()'
    @resize.window='checkWidth()'
    :class="' bg-gray-800 text-white h-full text-xs transition-all duration-500  '+(opensidebar?' w-full sm:w-48 overflow-y-auto':'w-13')">
    <x-lopsoft.control.sidebar-open />
    <x-lopsoft.control.sidebar-link
        icon='fa fa-home'
        link="{{ route('dashboard') }}"
        text='INICIO'
        help='INICIO'
        class='hover:text-blue-500'>
    </x-lopsoft.control.sidebar-link>
    @hasAbilityOr(["permission_groups.access", "permissions.access", "roles.access", "users.access"])
    <x-lopsoft.control.sidebar-menu
        icon='text-blue-500 fa fa-user'
        link='linkeando'
        text='ACCESOS'
        menuid='menuacceso'
        class='text-blue-500'>
        @hasAbility("permission_groups.access")
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('permission_groups.index') }}"
                text='GRUPOS DE PERMISOS'
                class='hover:text-red-500'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("permissions.access")
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('permissions.index') }}"
                text='PERMISOS'
                class='hover:text-red-500'
                help='PERMISOS'>
            </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("roles.access")
        <x-lopsoft.control.sidebar-sublink
            icon='hover:text-red-500 fa fa-user'
            link="{{ route('roles.index') }}"
            text='ROLES'
            class='hover:text-red-500'
            help='ROLES'>
        </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("users.access")
        <x-lopsoft.control.sidebar-sublink
            icon='hover:text-red-500 fa fa-user'
            link="{{ route('users.index') }}"
            text='USUARIOS'
            class='hover:text-red-500'
            help=''>
        </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
    </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr(['students.access'])
        <x-lopsoft.control.sidebar-menu
            icon='text-blue-500 fa fa-user'
            link='linkeando'
            text='ESTUDIANTES'
            menuid='menustudents'
            class='text-blue-500'>
            @hasAbility(['students.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('students.index') }}"
                text="{{ mb_strtoupper(__('lopsoft.tables.students')) }}"
                class='hover:text-red-500'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr(['colors.access','countries.access'])
        <x-lopsoft.control.sidebar-menu
            icon='text-blue-500 fa fa-user'
            link='linkeando'
            text='AUXILIARES'
            menuid='menuauxiliares'
            class='text-blue-500'>
            @hasAbility(['colors.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('colors.index') }}"
                text='COLORES'
                class='hover:text-red-500'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['countries.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('countries.index') }}"
                text="{{ mb_strtoupper(__('lopsoft.countries')) }}"
                class='hover:text-red-500'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['languages.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('languages.index') }}"
                text="{{ mb_strtoupper(__('lopsoft.tables.languages')) }}"
                class='hover:text-red-500'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr


    <x-lopsoft.control.sidebar-link
        icon='hover:text-red-500 fa fa-sign-out'
        text='SALIR'
        class='hover:text-red-500'
        onclick="document.getElementById('formlogout').submit();">
    </x-lopsoft.control.sidebar-link>

</div>
