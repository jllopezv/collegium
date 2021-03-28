<div class='navigation p-4 mt-2 d-flex justify-content-between vertical-center'>

    <div class='flex items-center justify-start'>
        <div>
            <a href="{{ route('website') }}">
                <img class='navigation-logo' src='{{ getImage(appsetting('WEBSITE_LOGO_SMALL')) }}' >
            </a>
        </div>
        <div class='text-left'>
            <div class='website_name'>TIA SANDRA SCHOOL</div>
            <div class='website_subname'>20 años de experiencia nos avalan</div>
        </div>
    </div>


    <div>
        <div class='text-right hide-in-sm'>
            <div>{!! appsetting('BUSINESS_PHONE')!='' ? '<a class="nolink bold color-gray" href="tel: '.getConfig('BUSINESS_PHONE').'"><i class="fas fa-phone-alt"></i> '.getConfig('BUSINESS_PHONE').'</a>' :'' !!}</div>
            <div class='nowhitespace'>{!! appsetting('BUSINESS_EMAIL')!='' ? '<a class="nolink color-gray bold" href="mailto: '.getConfig('BUSINESS_EMAIL').'"><i class="far fa-envelope"></i> '.getConfig('BUSINESS_EMAIL').'</a>' :'' !!}</div>
            <div><a class='nolink color-red bold' href="{{ route('website') }}">SECRETARIA VIRTUAL</a></div>
        </div>
        <div class='text-right p-0 m-0 hide-in-large'>
            <a href='route("website.secreatry") '>
                <i class='fas fa-headset color-red'></i>
            </a>
        </div>
        <div class='navbar-menu-toggler text-right'>
            <a class="navbar-toggler ml-auto no-border p-0" data-toggle="collapse" data-target="#navbarCollapse">
                <i class='fas fa-bars color-red'></i>
            </a>
        </div>


    </div>

</div>

<div>

    AQUI VA EL MENU

</div>
