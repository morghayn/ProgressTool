let focusedTask
let focusedTaskID
let focusedChoice
let focusedChoiceID

function focusTask(e)
{
    focusedTask = e
}

function focusTaskID(id)
{
    focusedTaskID = id
}

function focusChoice(e)
{
    focusedChoice = e
}

function focusChoiceID(id)
{
    focusedChoiceID = id
}

/**
 * Updates a tasks text via AJAX call.
 *
 * @param text
 */
function updateTask(text)
{
    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            type: 'POST',
            data:
                {
                    [token]: "1",
                    task: "tasks.updateTask",
                    format: "json",
                    taskID: focusedTaskID,
                    text: text
                },
            success: () => console.log('Saved task text.'),
            error: () => alert('Failed to save task text.'),
        }
    )
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
                    taskID: focusedTaskID,
                    choiceID: focusedChoiceID
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
    let token = jQuery("#token").attr("name")
    let orLogicID = 'u-t-' + focusedTaskID + '-l-0'
    let andLogicID = 'u-t-' + focusedTaskID + '-l-1'
    let orElem = document.getElementById(orLogicID)
    let andElem = document.getElementById(andLogicID)

    jQuery.ajax(
        {
            type: 'POST',
            data:
                {
                    [token]: "1",
                    task: "tasks.updateLogicID",
                    format: "json",
                    countryID: countryID,
                    taskID: focusedTaskID,
                    logicID: (logic === 0 ? 0 : 1)
                },
            success: () =>
            {
                if (logic === 0)
                {
                    orElem.classList.add('active')
                    andElem.classList.remove('active')
                }
                else if (logic === 1)
                {
                    andElem.classList.add('active')
                    orElem.classList.remove('active')
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
    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            type: 'POST',
            data:
                {
                    [token]: "1",
                    task: "tasks.addChoice",
                    format: "json",
                    countryID: countryID,
                    taskID: focusedTaskID,
                    choiceID: focusedChoiceID,
                },
            success: () =>
            {
                // TODO add choice to Task so it does not require page reload
            },
            error: () => alert('Failed to add choice to task.'),
        }
    )
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
    let buttons = focusedTask.querySelector('.task-buttons')
    let choices = focusedTask.querySelector('.task-choices')
    buttons.style.display = buttons.style.display === 'flex' ? 'none' : 'flex';
    choices.style.display = choices.style.display === 'block' ? 'none' : 'block';
}

/**
 * Toggles the visibility of all tasks.
 */
function toggleTasks(open)
{
    let buttons = document.querySelectorAll('.task-buttons')
    let choices = document.querySelectorAll('.task-choices')
    buttons.forEach(e => e.style.display = open ? 'flex' : 'none')
    choices.forEach(e => e.style.display = open ? 'block' : 'none')
}