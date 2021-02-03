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
