function toggleDisplay(formID, buttonChestID)
{
    toggle(document.getElementById(formID));
    toggle(document.getElementById(buttonChestID))
}

function toggleQuestionChoice()
{
    toggle(document.getElementById('questionChoiceForm'));
    toggle(document.getElementById('questionChoiceFormButtonChest'))
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

function removeIcon(questionID)
{
    window.location.href = (
        `index.php?option=com_progresstool` +
        `&view=questionEditor` +
        `&task=questionEditor.removeIcon` +
        `&questionID=${questionID}`
    )
}

function updateIconBottom(questionID, inputValue)
{
    let elem = document.getElementById(`iconChest${questionID}`);
    elem.style.bottom = inputValue + "px";
}

function updateIconRight(questionID, inputValue)
{
    let elem = document.getElementById(`iconChest${questionID}`);
    elem.style.right = inputValue + "px";
}