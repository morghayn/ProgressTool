function openTaskEditor(taskid)
{
    let task = document.querySelector('#' + taskid)
    let taskEditor = task.querySelector('.editor')

    taskEditor.style.display = taskEditor.style.display === 'block' ? 'none' : 'block'
}
