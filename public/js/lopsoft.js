function tabNextField(next_id)
{
    $("#"+next_id).focus();
}

function getScreenWidth()
{
    return window.innerWidth;
}

/**
 *  SIDEBAR FUNTIONALITY
 */


// AlpineJS Init Object for sidebar

function InitSidebar()
{
    return {
        opensidebar: true,
        showsidebar: false,
        open() {
            //if (this.opensidebar) return;
            this.opensidebar=true;
            ShowSidebar();
            // this.closeProfileMenu();
        },
        close() {
            //if (!this.opensidebar) return;
            this.opensidebar=true;
            HideSidebar();
            CloseAllSidebarMenu('none');
            // this.closeProfileMenu();
        },
        toggleSidebar() {
            if (this.opensidebar)
            {
                this.close();
            }
            else
            {
                this.open();
            }
        },
        openSidebarMenu(menuid) {
            if (!this.opensidebar)
            {
                this.open();
                return;
            }
            this.toggleSidebar();
            ShowSidebarMenu(menuid);
        },
        menuEvent(menuid)
        {
            if (!this.opensidebar) return;
            ShowSidebarMenu(menuid);
        },
        iconEvent(menuid)
        {
            if (!this.opensidebar)
            {
                this.open();
            }
            else
            {
                this.close();
            }
        },
        toggleVisibleSidebar()
        {
            this.closeProfileMenu();
            this.close();
            this.showsidebar=!this.showsidebar;
        },
        closeAll()
        {
            this.close();
            this.closeProfileMenu();
        },
        closeProfileMenu()
        {
            $("#profilemenu").fadeOut('fast');
        },
        checkWidth()
        {
            if (window.innerWidth<640)
            {
                this.showsidebar=false;
                this.close();
            }
            else
            {
                this.showsidebar=true;

                this.open();

                if (window.innerWidth>1024)
                {
                    this.opensidebar=true;
                    //ShowSidebar();

                }
                else
                {
                    this.opensidebar=false;
                    //HideSidebar();
                }

            }

        }
    }
}

function ShowSidebarMenu(id)
{
    if ($("#iconsidebarmenu_"+id).hasClass('fa-angle-down'))
    {
        ShowIconSidebar(id);
    }
    else
    {
        HideIconSidebar(id);
    }
    $("#sidebarmenu_"+id).slideToggle('fast');
}

function CloseAllSidebarMenu(id='')
{
    $("[id^='sidebarmenu_']").each(function() {
        if ( $(this).attr('id')!="sidebarmenu_"+id )
        {
            menuid=$(this).attr('id').substr(12,$(this).attr('id').length-11);
            HideIconSidebar(menuid);
            $(this).slideUp('fast');
        }
    })
}

function ShowSidebar()
{
    $("#iconopensidebar").hide();
    $("#iconopensidebar").removeClass('fa-angle-right');
    $("#iconopensidebar").fadeIn();
    $("#iconopensidebar").addClass('fa-angle-left');

}

function HideSidebar()
{
    $("#iconopensidebar").hide();
    $("#iconopensidebar").removeClass('fa-angle-left');
    $("#iconopensidebar").fadeIn();
    $("#iconopensidebar").addClass('fa-angle-right');


}

function ShowIconSidebar(id)
{
    $("#iconsidebarmenu_"+id).hide();
    $("#iconsidebarmenu_"+id).removeClass('fa-angle-down');
    $("#iconsidebarmenu_"+id).fadeIn();
    $("#iconsidebarmenu_"+id).addClass('fa-angle-up');
}

function HideIconSidebar(id)
{
    $("#iconsidebarmenu_"+id).hide();
    $("#iconsidebarmenu_"+id).removeClass('fa-angle-up');
    $("#iconsidebarmenu_"+id).fadeIn();
    $("#iconsidebarmenu_"+id).addClass('fa-angle-down');
}

/*
    LISTENERS
*/

window.addEventListener('alertmsg', event => {
    switch(event.detail.type)
    {
        case 'error':
            ShowError(event.detail.msg,event.detail.submsg,event.detail.title,event.detail.showtitle,event.detail.timeout);
            break;
        case 'success':
            ShowSuccess(event.detail.msg,event.detail.submsg,event.detail.title,event.detail.showtitle,event.detail.timeout);
            break;
        case 'warning':
            ShowWarning(event.detail.msg,event.detail.submsg,event.detail.title,event.detail.showtitle,event.detail.timeout);
            break;
        case 'debug':
            ShowDebug(event.detail.msg,event.detail.submsg,event.detail.title,event.detail.showtitle,event.detail.errorcode, event.detail.timeout);
            break;
        default:
            ShowInfo(event.detail.msg,event.detail.submsg,event.detail.title,event.detail.showtitle,event.detail.timeout);

    }

})





function ShowAlertError(noty_text,noty_subtext,noty_title="ERROR",showTitle=false, tout=3000)
{
    message='<div class="noty-title"><i class="fas fa-exclamation-circle"></i> '+noty_title+'</div><div class="noty-body">'+noty_text+'</div>';

    if ( !showTitle )
    {
        message='<div class="noty-title"><i class="fas fa-exclamation-circle"></i> '+noty_text+'</div>';

    }

    message+='<div class="noty-subtitle">'+noty_subtext+'</div>';

    var n=new Noty({
        type: 'error',
        theme: 'gnosys',
        text: message,
        progressBar: false,
        timeout: tout,

    }).show();

    return n;
}


function ShowAlertInfo(noty_text,noty_subtext,noty_title="INFO",showTitle=false, tout=3000)
{
    message='<div class="noty-title"><i class="fas fa-info-circle"></i> '+noty_title+'</div><div class="noty-body">'+noty_text+'</div>';

    if ( !showTitle )
    {
        message='<div class="noty-title"><i class="fas fa-info-circle"></i> '+noty_text+'</div>';

    }

    message+='<div class="noty-subtitle">'+noty_subtext+'</div>';

    var n=new Noty({
        type: 'info',
        theme: 'gnosys',
        text: message,
        progressBar: false,
        timeout: tout,

    }).show();

    return n;
}


function ShowAlertSuccess(noty_text,noty_subtext="",noty_title="EXITO", showTitle=false, tout=3000)
{
    message='<div class="noty-title"><i class="fas fa-check-circle"></i> '+noty_title+'</div><div class="noty-body">'+noty_text+'</div>';

    if ( !showTitle )
    {
        message='<div class="noty-title"><i class="fas fa-check-circle"></i> '+noty_text+'</div>';

    }

    if (noty_subtext!="") message+='<div class="noty-subtitle">'+noty_subtext+'</div>';

    var n=new Noty({
        type: 'success',
        theme: 'gnosys',
        text: message,
        progressBar: false,
        timeout: tout,

    }).show();

    return n;
}



function ShowAlertWarning(noty_text,noty_subtext,noty_title="ATENCION", showTitle=false, tout=3000 )
{
    message='<div class="noty-title"><i class="fas fa-exclamation-triangle"></i> '+noty_title+'</div><div class="noty-body">'+noty_text+'</div>';

    if ( !showTitle )
    {
        message='<div class="noty-title"><i class="fas fa-exclamation-triangle"></i> '+noty_text+'</div>';

    }

    message+='<div class="noty-subtitle">'+noty_subtext+'</div>';

    var n=new Noty({
        type: 'warning',
        theme: 'gnosys',
        text: message,
        progressBar: false,
        timeout: tout,

    }).show();

    return n;
}


function ShowAlertDebug(noty_text, noty_subtext, noty_title="", error_code, tout=3000 )
{

    var message='<div class="noty-title"><i class="fas fa-bug"></i> DEBUG / CODE '+error_code+'</div>';

    message+='<div class="noty-subtitle">'+noty_subtext+'</div>';
    message+='<div class="noty-body">'+noty_text+'</div>';



    var n=new Noty({
        type: 'debug',
        theme: 'gnosys',
        text: message,
        title: "Hola",
        timeout: tout,
        progressBar: false,

    }).show();

    return n;
}



function ShowInfo(noty_text,noty_subtext="", noty_title="", showTitle=false, tout=3000)
{
    var n=ShowAlertInfo(noty_text,noty_subtext,noty_title,showTitle, tout);

    return n;
}


function ShowError(noty_text,noty_subtext="", noty_title="", showTitle=false, tout=3000)
{
    var n=ShowAlertError(noty_text,noty_subtext,noty_title,showTitle, tout);

    return n;
}


function ShowWarning(noty_text,noty_subtext="", noty_title="", showTitle=false, tout=3000)
{
    var n=ShowAlertWarning(noty_text,noty_subtext,noty_title,showTitle, tout);

    return n;
}


function ShowSuccess(noty_text,noty_subtext="", noty_title="",showTitle=false, tout=3000)
{
    var n=ShowAlertSuccess(noty_text,noty_subtext,noty_title,showTitle, tout);

    return n;
}

function ShowDebug(noty_text,noty_subtext="", noty_title, error_code, showTitle=false, tout=3000)
{
    var n=ShowAlertDebug(noty_text,noty_subtext,noty_title,showTitle, error_code, tout);

    return n;
}

function ShowInfoFixed(noty_text,noty_subtext="", noty_title="", showTitle=false, tout=false)
{
    var n=ShowAlertInfo(noty_text,noty_subtext,noty_title,showTitle, tout);

    return n;
}


function ShowErrorFixed(noty_text,noty_subtext="", noty_title="", showTitle=false, tout=false)
{
    var n=ShowAlertError(noty_text,noty_subtext,noty_title,showTitle, tout);

    return n;
}


function ShowWarningFixed(noty_text,noty_subtext="", noty_title="", showTitle=false, tout=false)
{
    var n=ShowAlertWarning(noty_text,noty_subtext,noty_title,showTitle, tout);

    return n;
}


function ShowSuccessFixed(noty_text,noty_subtext="", noty_title="", showTitle=false, tout=false)
{
    var n=ShowAlertSuccess(noty_text,noty_subtext,noty_title,showTitle, tout);

    return n;
}
