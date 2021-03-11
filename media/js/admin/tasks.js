let focusedTask
let focusedTaskID
let focusedChoice
let focusedChoiceID

function focusTask(id)
{
    focusedTaskID = id
    focusedTask = document.getElementById(focusedTaskID)
}

function focusChoice(id)
{
    focusedChoiceID = id
    focusedChoice = document.getElementById(focusedChoiceID)
}

/**
 * Removes choice via AJAX call.
 */
function removeChoice()
{
    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            type: 'POST',
            data:
                {
                    [token]: "1",
                    task: "tasks.removeChoice",
                    format: "json",
                    countryID: countryID,
                    taskID: focusedTaskID.substring(7),
                    choiceID: focusedChoiceID.substring(9)
                },
            success: () => focusedChoice.outerHTML = '',
            error: () => alert('Failed to remove choice.'),
        }
    )
}

/**
 * Toggles task logic via AJAX call.
 *
 * @param logic
 */
function logicToggle(logic)
{
    let logicToggle = focusedTask.querySelector('#buttons').querySelector('#logicToggle')

    let or = logicToggle.querySelector('#or')
    let and = logicToggle.querySelector('#and')

    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            type: 'POST',
            data:
                {
                    [token]: "1",
                    task: "tasks.updateLogicID",
                    format: "json",
                    countryID: countryID,
                    taskID: focusedTaskID.substring(7),
                    logicID: (logic === 'or' ? 0 : 1)
                },
            success: () =>
            {
                if (logic === 'or')
                {
                    or.classList.add('active')
                    and.classList.remove('active')
                }
                else if (logic === 'and')
                {
                    and.classList.add('active')
                    or.classList.remove('active')
                }
            },
            error: () => alert('Failed to update logic.'),
        }
    )
}

/**
 * Adds choice to a task via AJAX call.
 */
function addChoice()
{
    // Triggering modal close button
    document.getElementsByClassName("amClose")[0].click()

    alert(focusedChoiceID)

    // TODO AJAX REQUEST TO ADD CHOICE
    //      // TODO AJAX REQUEST TO HANDLE ERROR
    // TODO AJAX REQUEST TO RECEIVE CHOICE
    //      // TODO AJAX REQUEST TO HANDLE ERROR
}

/**
 * Opens modal for choice selection.
 */
function openModal()
{
    // Displaying the modal
    let modal = document.getElementById("adminModal")
    modal.style.display = "block"

    // Temporarily removing the administrator heading's stickiness
    const heading = document.querySelector('#heading')
    heading.classList.remove("stickyHeading")

    // Adding event listener for modal close button
    document.getElementsByClassName("amClose")[0].onclick = () =>
    {
        modal.style.display = "none"
        heading.classList.add("stickyHeading")
    }

    // Adding event listener for modal closure via clicking outside modal
    window.onclick = (event) =>
    {
        if (event.target === modal)
        {
            modal.style.display = "none"
            heading.classList.add("stickyHeading")
        }
    }
}

/**
 * Toggles the visibility of a task.
 */
function toggleTask()
{
    let buttons = focusedTask.querySelector('#buttons')
    let choices = focusedTask.querySelector('#choices')
    buttons.style.display = buttons.style.display === 'flex' ? 'none' : 'flex';
    choices.style.display = choices.style.display === 'block' ? 'none' : 'block';
}

/**
 * Toggles the visibility of all tasks.
 */
function toggleTasks(open)
{
    let buttons = document.querySelectorAll('#buttons')
    let choices = document.querySelectorAll('#choices')
    buttons.forEach(e => e.style.display = open ? 'flex' : 'none')
    choices.forEach(e => e.style.display = open ? 'block' : 'none')
}