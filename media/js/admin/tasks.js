function openTaskEditor(taskid)
{
    let task = document.querySelector('#' + taskid)
    let taskEditor = task.querySelector('.editor')

    //taskEditor.style.display = taskEditor.style.display === 'block' ? 'none' : 'block'
    taskEditor.style.display = 'block';
}

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