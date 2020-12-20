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
        text="{{ transup('home') }}"
        help="{{ transup('home') }}"
        class='hover:text-green-300'>
    </x-lopsoft.control.sidebar-link>
    @hasAbilityOr(["permission_groups.access", "permissions.access", "roles.access", "users.access"])
    <x-lopsoft.control.sidebar-menu
        icon='fa fa-user'
        link='linkeando'
        text="{{ transup('access') }}"
        help="{{ transup('access') }}"
        menuid='menuacceso'
        classmenu='hover:text-green-300'>
        @hasAbility("users.access")
        <x-lopsoft.control.sidebar-sublink
            icon='hover:text-red-500 fa fa-user'
            link="{{ route('users.index') }}"
            text="{{ transup('users') }}"
            class='hover:text-green-300'
            help=''>
        </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("roles.access")
        <x-lopsoft.control.sidebar-sublink
            icon='hover:text-red-500 fa fa-user'
            link="{{ route('roles.index') }}"
            text="{{ transup('roles') }}"
            class='hover:text-green-300'
            help=''>
        </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("permissions.access")
        <x-lopsoft.control.sidebar-sublink
            icon='hover:text-red-500 fa fa-user'
            link="{{ route('permissions.index') }}"
            text="{{ transup('permissions') }}"
            class='hover:text-green-300'
            help=''>
        </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("permission_groups.access")
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('permission_groups.index') }}"
                text="{{ transup('permission_grp') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
    </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr(['students.access', 'school_levels.access', 'school_grades.access'])
        <x-lopsoft.control.sidebar-menu
            icon='fa fa-user'
            link='linkeando'
            text="{{ transup('academic') }}"
            help="{{ transup('academic') }}"
            menuid='menuacademico'
            classmenu='hover:text-green-300'>
            @hasAbility(['school_levels.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('school_levels.index') }}"
                text="{{ transup('schoollevels') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['school_grades.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('school_grades.index') }}"
                text="{{ transup('schoolgrades') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['students.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('students.index') }}"
                text="{{ transup('tables.students') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr(['annos.access'])
        <x-lopsoft.control.sidebar-menu
            icon='fa fa-user'
            link='linkeando'
            text="{{ transup('config') }}"
            menuid='menuconfig'
            classmenu='hover:text-green-300'>
            @hasAbility(['annos.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('annos.index') }}"
                text="{{ transup('tables.annos') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr(['colors.access','countries.access'])
        <x-lopsoft.control.sidebar-menu
            icon='fa fa-user'
            link='linkeando'
            text='AUXILIARES'
            menuid='menuauxiliares'
            classmenu='hover:text-green-300'>
            @hasAbility(['colors.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('colors.index') }}"
                text="{{ transup('colors') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['countries.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('countries.index') }}"
                text="{{ transup('tables.countries') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['languages.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('languages.index') }}"
                text="{{ transup('tables.languages') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr


    <x-lopsoft.control.sidebar-link
        icon='hover:text-red-500 fa fa-sign-out'
        text="{{ transup('exit') }}"
        help="{{ transup('exit') }}"
        class='hover:text-red-500'
        onclick="document.getElementById('formlogout').submit();">
    </x-lopsoft.control.sidebar-link>

</div>
