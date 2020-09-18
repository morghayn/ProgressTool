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

function addChoice(questionID)
{
    window.location.href = (
        `index.php?option=com_progresstool` +
        `&view=questionEditor` +
        `&task=questionEditor.addChoice` +
        `&questionID=${questionID}`
    )
}

function deleteChoice(choiceID)
{
    window.location.href = (
        `?option=com_progresstool` +
        `&view=questionEditor` +
        `&task=questionEditor.deleteChoice` +
        `&choiceID=${choiceID}`
    )
}

function deleteIcon(questionID)
{
    window.location.href = (
        `index.php?option=com_progresstool` +
        `&view=questionEditor` +
        `&task=questionEditor.deleteIcon` +
        `&questionID=${questionID}`
    )
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