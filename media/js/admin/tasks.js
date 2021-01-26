function openTaskEditor(taskid)
{
    let task = document.querySelector('#' + taskid)
    let taskEditor = task.querySelector('.editor')

    //taskEditor.style.display = taskEditor.style.display === 'block' ? 'none' : 'block'
    taskEditor.style.display = 'block';
}

function buildTaskObject(taskid)
{
    let task = document.querySelector('#' + taskid)
    let taskValue = task.querySelector('#task')

    alert(taskValue.innerHTML)
}