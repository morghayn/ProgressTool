function openNav()
{
    let currentWidth = document.getElementById("sideNavigation").style.width;

    if (currentWidth !== '250px')
    {
        document.getElementById("sideNavigation").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }
    else
    {
        document.getElementById("sideNavigation").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
}

function closeNav()
{
    document.getElementById("sideNavigation").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}