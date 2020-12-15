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