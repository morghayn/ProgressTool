function openTaskEditor(taskid)
{
    let task = document.querySelector('#' + taskid)
    let taskEditor = task.querySelector('.editor')

    //taskEditor.style.display = taskEditor.style.display === 'block' ? 'none' : 'block'
    taskEditor.style.display = 'block';
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