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
    } else
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

function updateIconWidth(inputValue)
{
    let elem = document.getElementById(`iconChest`);
    elem.style.width = inputValue + "px";
}

function updateIconHeight(inputValue)
{
    let elem = document.getElementById(`iconChest`);
    elem.style.height = inputValue + "px";
}