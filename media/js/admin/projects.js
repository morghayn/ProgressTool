/**
 * POST request to delete a project.
 *
 * @param projectID
 */
function deleteProject(projectID)
{
    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            type: 'POST',
            data: {[token]: "1", task: "projects.delete", format: "json", projectID: projectID},
            success: (result) =>
            {
                if (result.data === true)
                {
                    console.log(result.projectID)
                }
            },
            error: () => console.log('Failure to perform affirm(). Contact an dashboard if this failure persists.'),
        }
    )
}


function loadProjectEditorTable(projectID)
{
    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            type: 'GET',
            data: {[token]: "1", task: "projects.getProjectEditorTable", format: "raw", projectID: projectID},
            success: (result) =>
            {
                // TODO check if result actually exists first...
                let projectEditorTable = document.getElementById("projectEditorTable")
                projectEditorTable.innerHTML = result
            },
            error: () => console.log('Failure to perform affirm(). Contact an dashboard if this failure persists.'),
        }
    )
}


function openModal(projectID)
{
    // Get the modal
    let modal = document.getElementById("projectModal")
    modal.style.display = "block"

    // Populating project editor table
    loadProjectEditorTable(projectID)

    // Get the <span> element that closes the modal
    let span = document.getElementsByClassName("closeProjectModal")[0]

    // When the user clicks on <span> (x), close the modal
    span.onclick = () => modal.style.display = "none"

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = (event) =>
    {
        if (event.target === modal)
        {
            modal.style.display = "none"
        }
    }
}


function searchTable()
{
    // Declare variables
    let input, filter, table, tr, field1, field2, i, txtValue
    input = document.getElementById("myInput")
    filter = input.value.toUpperCase()
    table = document.getElementById("projectTable")
    tr = table.getElementsByTagName("tr")

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++)
    {
        field1 = tr[i].getElementsByTagName("td")[1]
        field2 = tr[i].getElementsByTagName("td")[2]
        if (field1)
        {
            txtValue = (field1.textContent || field1.innerText) + (field2.textContent || field2.innerText)
            if (txtValue.toUpperCase().indexOf(filter) > -1)
            {
                tr[i].style.display = ""
            }
            else
            {
                tr[i].style.display = "none"
            }
        }
    }
}
