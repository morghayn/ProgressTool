function opensesame(boxName)
{
    var x = document.getElementById(boxName);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}