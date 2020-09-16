function updateIconBottom(questionID, inputValue)
{
    let elem = document.getElementById(`iconChest${questionID}`);
    elem.style.bottom = inputValue  + "px";
}

function updateIconRight(questionID, inputValue)
{
    let elem = document.getElementById(`iconChest${questionID}`);
    elem.style.right = inputValue  + "px";
}