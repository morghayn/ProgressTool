/**
 * Sets style of task editor for a particular task to 'block'.
 *
 * @param taskID
 */
function openTaskEditor(taskID)
{
    let task = document.querySelector('#' + taskID)
    let taskEditor = task.querySelector('.editor')

    taskEditor.style.display = 'block';
}

function openAllTaskEditors()
{
    let taskEditors = document.querySelectorAll('.editor')
    taskEditors.forEach(e => e.style.display = 'block')
}

function closeAllTaskEditors()
{
    let taskEditors = document.querySelectorAll('.editor')
    taskEditors.forEach(e => e.style.display = 'none')
}

/**
 * AJAX post to controller requesting for a choice to be removed.
 *
 * @param taskID
 * @param choiceID
 */
function removeChoice(taskID, choiceID)
{
    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            type: 'POST',
            data: {[token]: "1", task: "tasks.removeChoice", format: "json", taskID: taskID, choiceID: choiceID},
            success: () =>
            {
                let choiceElement = document.getElementById('choiceid-' + choiceID)
                choiceElement.outerHTML = ''
            },
            error: () =>
            {
                console.log('Failed to remove choice.')
            },
        }
    )
}

function openModal()
{
    let modal = document.getElementById("ptModal")
    modal.style.display = "block"

    const heading = document.querySelector('#heading');
    if (heading.classList.contains("stickyHeading"))
    {
        heading.classList.remove("stickyHeading");

    }

    let span = document.getElementsByClassName("ptCloseModal")[0]
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