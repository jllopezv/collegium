<div
    id='sidebar'
    x-cloak
    x-show.transition.opacity.duration.500ms='showsidebar'
    x-on:click.away='showsidebar=false'
    {{-- x-on:click.away='if (opensidebar==true)  checkWidth()' --}}
    {{-- @resize.window='checkWidth()' --}}
    :class="'absolute top-0 left-0 z-50 bg-gray-800 text-white h-full text-xs transition-all duration-500 w-72 overflow-y-auto nosb'">
    {{-- <x-lopsoft.control.sidebar-open /> --}}
    <x-lopsoft.control.sidebar-link
        icon='fa fa-home'
        link="{{ route('dashboard') }}"
        text="{{ transup('home') }}"
        help="{{ transup('home') }}"
        class='hover:text-green-300'>
    </x-lopsoft.control.sidebar-link>
    @hasAbilityOr(['app.settings', 'app_settings.access', 'app_setting_pages.access', 'model_config.access'])
        <x-lopsoft.control.sidebar-menu
            icon='fa fa-cogs'
            text="{{ transup('config') }}"
            menuid='menuconfig'
            classmenu='hover:text-green-300'>
            @hasAbility(['app.settings'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-cogs'
                link="{{ route('app.settings') }}"
                text="{{ transup('config') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['app_settings.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-tools'
                link="{{ route('app_settings.index') }}"
                text="{{ transup('tables.app_settings') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['app_setting_pages.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-tools'
                link="{{ route('app_setting_pages.index') }}"
                text="{{ transup('tables.app_setting_pages') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['model_configs.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-tools'
                link="{{ route('model_configs.index') }}"
                text="{{ transup('tables.model_configs') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr(["permission_groups.access", "permissions.access", "roles.access", "users.access"])
    <x-lopsoft.control.sidebar-menu
        icon='fa fa-user'
        link='linkeando'
        text="{{ transup('access') }}"
        help="{{ transup('access') }}"
        menuid='menuacceso'
        classmenu='hover:text-red-400'>
        @hasAbility("users.access")
        <x-lopsoft.control.sidebar-sublink
            icon='hover:text-red-500 fa fa-user'
            link="{{ route('users.index') }}"
            text="{{ transup('users') }}"
            class='hover:text-red-400'
            help=''>
        </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("roles.access")
        <x-lopsoft.control.sidebar-sublink
            icon='hover:text-red-500 fa fa-user'
            link="{{ route('roles.index') }}"
            text="{{ transup('roles') }}"
            class='hover:text-red-400'
            help=''>
        </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("permissions.access")
        <x-lopsoft.control.sidebar-sublink
            icon='hover:text-red-500 fa fa-user'
            link="{{ route('permissions.index') }}"
            text="{{ transup('permissions') }}"
            class='hover:text-red-400'
            help=''>
        </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
        @hasAbility("permission_groups.access")
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user'
                link="{{ route('permission_groups.index') }}"
                text="{{ transup('permission_grp') }}"
                class='hover:text-red-400'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
        @endhasAbility
    </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr([ 'website_post_cats.access',
                    'website_banners.access',
                    'website_posts.access',
                    'website_pages.access',
                    'website_menus.access',
                    'website_news.access',
                    'website_news_cats.access',
                    'website_news.access',
                    'website_news_cats.access',
                    ])
        <x-lopsoft.control.sidebar-menu
            icon='fa fa-globe'
            text="{{ transup('website') }}"
            menuid='menuwebsite'
            classmenu='hover:text-green-300'>
            @hasAbility(['website_menus.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-bars'
                link="{{ route('website_menus.index') }}"
                text="{{ transup('website_menus') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['website_pages.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-file-alt'
                link="{{ route('website_pages.index') }}"
                text="{{ transup('website_pages') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['website_banners.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-object-group'
                link="{{ route('website_banners.index') }}"
                text="{{ transup('banners') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            <x-lopsoft.control.sidebar-separator />
            @hasAbility(['website_advertisements.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-ad'
                link="{{ route('website_advertisements.index') }}"
                text="{{ transup('website_advertisements') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['website_advertisement_cats.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-align-justify'
                link="{{ route('website_advertisement_cats.index') }}"
                text="{{ transup('website_advertisement_cats') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            <x-lopsoft.control.sidebar-separator />
            @hasAbility(['website_posts.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-sticky-note'
                link="{{ route('website_posts.index') }}"
                text="{{ transup('posts') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['website_post_cats.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-align-justify'
                link="{{ route('website_post_cats.index') }}"
                text="{{ transup('post_categories') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            <x-lopsoft.control.sidebar-separator />
            @hasAbility(['website_news.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-newspaper'
                link="{{ route('website_news.index') }}"
                text="{{ transup('website_news') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['website_news_cats.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='fa fa-align-justify'
                link="{{ route('website_news_cats.index') }}"
                text="{{ transup('website_news_cats') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr([ 'students.access' ])
        <x-lopsoft.control.sidebar-menu
            icon='fa fa-user-graduate'
            text="{{ transup('students') }}"
            help="{{ transup('students') }}"
            menuid='menustudent'
            classmenu='hover:text-green-300'>
            @hasAbility(['students.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user-graduate'
                link="{{ route('students.index') }}"
                text="{{ transup('students') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['school_parents.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user-graduate'
                link="{{ route('school_parents.index') }}"
                text="{{ transup('tables.school_parents') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr
    @hasAbilityOr([ 'school_levels.access', 'school_grades.access',
                    'school_batches.access', 'school_modalities.access', 'school_sections.access'])
        <x-lopsoft.control.sidebar-menu
            icon='fa fa-graduation-cap'
            link='linkeando'
            text="{{ transup('academic') }}"
            help="{{ transup('academic') }}"
            menuid='menuacademico'
            classmenu='hover:text-green-300'>
            @hasAbility(['school_levels.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-graduation-cap'
                link="{{ route('school_levels.index') }}"
                text="{{ transup('levels') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['school_grades.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-graduation-cap'
                link="{{ route('school_grades.index') }}"
                text="{{ transup('grades') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['school_sections.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-graduation-cap'
                link="{{ route('school_sections.index') }}"
                text="{{ transup('sections') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['school_batches.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-graduation-cap'
                link="{{ route('school_batches.index') }}"
                text="{{ transup('batches') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['school_modalities.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-graduation-cap'
                link="{{ route('school_modalities.index') }}"
                text="{{ transup('modalities') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['annos.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-graduation-cap'
                link="{{ route('annos.index') }}"
                text="{{ transup('tables.annos') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['students.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user-graduate'
                link="{{ route('students.index') }}"
                text="{{ transup('tables.students') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
            @hasAbility(['school_parents.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-user-graduate'
                link="{{ route('school_parents.index') }}"
                text="{{ transup('tables.school_parents') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr

    @hasAbilityOr(['colors.access', 'languages.access', 'countries.access', 'images.access'])
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
            @hasAbility(['images.access'])
            <x-lopsoft.control.sidebar-sublink
                icon='hover:text-red-500 fa fa-image'
                link="{{ route('images.index') }}"
                text="{{ transup('tables.images') }}"
                class='hover:text-green-300'
                help=''>
            </x-lopsoft.control.sidebar-sublink>
            @endhasAbility
        </x-lopsoft.control.sidebar-menu>
    @endhasAbilityOr

    <x-lopsoft.control.sidebar-link
        icon='hover:text-red-500 fa fa-file'
        text="{{ transup('filemanger') }}"
        help="{{ transup('filemanager') }}"
        class='hover:text-blue-500'
        link="{{ route('filemanager.test') }}">
    </x-lopsoft.control.sidebar-link>
    <x-lopsoft.control.sidebar-link
        icon='hover:text-red-500 fa fa-sign-out'
        text="{{ transup('exit') }}"
        help="{{ transup('exit') }}"
        class='hover:text-red-500'
        onclick="document.getElementById('formlogout').submit();">
    </x-lopsoft.control.sidebar-link>

</div>
