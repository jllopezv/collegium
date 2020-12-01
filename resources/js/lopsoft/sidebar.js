/**
 *  SIDEBAR FUNTIONALITY
 */


// AlpineJS Init Object for sidebar

function InitSidebar()
{
    return {
        opensidebar: false,
        showsidebar: true,
        open() {
            if (this.opensidebar) return;
            this.opensidebar=true;
            ShowSidebar();
            // this.closeProfileMenu();
        },
        close() {
            if (!this.opensidebar) return;
            this.opensidebar=false;
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
