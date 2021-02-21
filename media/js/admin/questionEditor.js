function addChoice(questionID)
{
    let token = jQuery("#token").attr("name");

    window.location.href = (
        `index.php?option=com_progresstool` +
        `&view=questionEditor` +
        `&task=questionEditor.addChoice` +
        `&${token}=1` +
        `&questionID=${questionID}`
    )
}

function deleteChoice(questionID, choiceID)
{
    let token = jQuery("#token").attr("name");

    window.location.href = (
        `?option=com_progresstool` +
        `&view=questionEditor` +
        `&task=questionEditor.deleteChoice` +
        `&${token}=1` +
        `&questionID=${questionID}` +
        `&choiceID=${choiceID}`
    )
}

function deleteIcon(questionID)
{
    let token = jQuery("#token").attr("name");

    window.location.href = (
        `index.php?option=com_progresstool` +
        `&view=questionEditor` +
        `&task=questionEditor.deleteIcon` +
        `&${token}=1` +
        `&questionID=${questionID}`
    )
}

function toggleDisplay(formID, buttonChestID)
{
    toggle(document.getElementById(formID));
    toggle(document.getElementById(buttonChestID))
}

function toggleQuestionForm()
{
    toggle(document.getElementById('questionForm'));
    toggle(document.getElementById('questionFormButtonChest'))
}

function toggleQuestionChoiceForm()
{
    toggle(document.getElementById('questionChoiceForm'));
    toggle(document.getElementById('questionChoiceFormButtonChest'))
}

function toggleIconForm()
{
    toggle(document.getElementById('iconForm'));
    toggle(document.getElementById('iconFormButtonChest'))
}

function toggle(x)
{
    if (x.style.display === "none")
    {
        x.style.display = "flex";
    }
    else
    {
        x.style.display = "none";
    }
}

function updatePreview(elementID, value)
{
    let elem = document.getElementById(elementID)
    elem.innerText = value;
}

function updateIconBottom(inputValue)
{
    let elem = document.getElementById(`iconChest`);
    elem.style.bottom = inputValue + "px";
}

function updateIconRight(inputValue)
{
    let elem = document.getElementById(`iconChest`);
    elem.style.right = inputValue + "px";
}

function updateIconWidth()
{
    let heightToggle = document.getElementById('heightToggle');
    let widthToggle = document.getElementById('widthToggle');
    let aspectLock = document.getElementById('lockIconAspectRation').checked;
    let iconChest = document.getElementById('iconChest');
    let newValue = widthToggle.value;

    if (aspectLock)
    {
        let width = parseInt(iconChest.style.width);
        let height = parseInt(iconChest.style.height);
        let ratio = (height / width);
        let newHeight = Math.round((newValue * ratio));
        //let newHeight = (newValue * ratio);

        iconChest.style.width = newValue + "px";
        iconChest.style.height = newHeight + "px";

        heightToggle.value = newHeight;
    }
    else
    {
        iconChest.style.width = newValue + "px";
    }
}

function updateIconHeight()
{
    let heightToggle = document.getElementById('heightToggle');
    let widthToggle = document.getElementById('widthToggle');
    let aspectLock = document.getElementById('lockIconAspectRation').checked;
    let iconChest = document.getElementById('iconChest');
    let newValue = heightToggle.value;

    if (aspectLock)
    {
        let width = parseInt(iconChest.style.width);
        let height = parseInt(iconChest.style.height);
        let ratio = (width / height);
        let newWidth = Math.round((newValue * ratio));
        //let newWidth = (newValue * ratio);

        iconChest.style.height = newValue + "px";
        iconChest.style.width = newWidth + "px";

        widthToggle.value = newWidth;
    }
    else
    {
        iconChest.style.width = newValue + "px";
    }
}


function dragElement(elem)
{
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById(elem.id + "header"))
    {
        /* if present, the header is where you move the DIV from:*/
        document.getElementById(elem.id + "header").onmousedown = dragMouseDown;
    }
    else
    {
        /* otherwise, move the DIV from anywhere inside the DIV:*/
        elem.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e)
    {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e)
    {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elem.style.top = (elem.offsetTop - pos2) + "px";
        elem.style.left = (elem.offsetLeft - pos1) + "px";
    }

    function closeDragElement()
    {
        /* stop moving when mouse button is released:*/
        document.onmouseup = null;
        document.onmousemove = null;
    }
}