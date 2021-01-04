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


function openModal(/* Pass necessary data through to build custom modal for each project via AJAX*/)
{
    // Get the modal
    let modal = document.getElementById("projectModal")
    modal.style.display = "block"

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
