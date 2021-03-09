let focusedTask
let focusedChoice

function focusTask(id)
{
    focusedTask = id
}

function focusChoice(id)
{
    focusedChoice = id
}

/**
 * AJAX post to controller requesting for a choice to be removed.
 */
function removeChoice()
{
    let token = jQuery("#token").attr("name")
    let choiceID = focusedChoice

    jQuery.ajax(
        {
            type: 'POST',
            data: {[token]: "1", task: "tasks.removeChoice", format: "json", taskID: focusedTask, choiceID: choiceID},
            success: () => document.getElementById(choiceID).outerHTML = '',
            error: () => alert('Failed to remove choice.'),
        }
    )
}


// TODO vvvvvvvvvv
// TODO vvvvvvvvvv
// TODO vvvvvvvvvv
// TODO vvvvvvvvvv


function logicToggle(logic)
{
    let task = document.querySelector('#' + focusedTask)
    let buttons = task.querySelector('#buttons')
    let logicToggle = buttons.querySelector('#logicToggle')

    let or = logicToggle.querySelector('#or')
    let and = logicToggle.querySelector('#and')

    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            type: 'POST',
            data: {[token]: "1", task: "tasks.updateLogic", format: "json", taskID: focusedTask, logic: (logic === 'or' ? 0 : 1)},
            success: () =>
            {
                if (logic === 'or' && !or.classList.contains('active'))
                {
                    or.classList.add('active')
                    and.classList.remove('active')
                }
                else if (logic === 'and' && !and.classList.contains('active'))
                {
                    and.classList.add('active')
                    or.classList.remove('active')
                }
            },
            error: () =>
            {
                alert('Failed to remove choice.')
            },
        }
    )
}

/**
 * Opens choice selector modal.
 */
function openChoiceSelector()
{
    let modal = document.getElementById("adminModal")
    modal.style.display = "block"

    const heading = document.querySelector('#heading')
    if (heading.classList.contains("stickyHeading"))
    {
        heading.classList.remove("stickyHeading")

    }

    let span = document.getElementsByClassName("amClose")[0]
    span.onclick = () =>
    {
        modal.style.display = "none"
        heading.classList.add("stickyHeading")
    }

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
 * Adds selected choice to currently focused task.
 *
 * @param choiceID
 */
function addChoice(choiceID)
{
    let modal = document.getElementById("adminModal")

    // If success
    modal.style.display = "none"
    heading.classList.add("stickyHeading")

    alert(choiceID)

    // TODO AJAX REQUEST TO ADD CHOICE
    //      // TODO AJAX REQUEST TO HANDLE ERROR
    // TODO AJAX REQUEST TO RECEIVE CHOICE
    //      // TODO AJAX REQUEST TO HANDLE ERROR
}

/**
 * Sets style of task editor for a particular task to 'block'.
 */
function toggleTaskEditor()
{
    let task = document.querySelector('#' + focusedTask)
    let buttons = task.querySelector('#buttons')
    let choices = task.querySelector('#choices')

    buttons.style.display = buttons.style.display === 'flex' ? 'none' : 'flex';
    choices.style.display = choices.style.display === 'block' ? 'none' : 'block';
}

/**
 * Opens task editor for every task.
 */
function openAllTaskEditors()
{
    let buttons = document.querySelectorAll('#buttons')
    let choices = document.querySelectorAll('#choices')
    buttons.forEach(e => e.style.display = 'flex')
    choices.forEach(e => e.style.display = 'block')
}

/**
 * Closes task editor for every task.
 */
function closeAllTaskEditors()
{
    let buttons = document.querySelectorAll('#buttons')
    let choices = document.querySelectorAll('#choices')
    buttons.forEach(e => e.style.display = 'none')
    choices.forEach(e => e.style.display = 'none')
}

// TODO REMOVE?
function buildTaskObject(taskid)
{
    // empty task object
    let taskObject = {
        task: '',
        choices: []
    }

    // collecting task string
    let task = document.querySelector('#' + taskid)
    taskObject.task = task.querySelector('#task').innerHTML

    // collecting cids
    let choicesDiv = task.querySelector('#choices')
    let choices = choicesDiv.querySelectorAll('h3')
    choices.forEach(e => taskObject.choices.push(e.id))

    alert(JSON.stringify(taskObject))
}