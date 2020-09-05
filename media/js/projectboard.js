/**
 * Shows all projects on the projectboard. Request made by the dropdown box.
 */
function showAll()
{
    window.location = '?option=com_progresstool&view=projectboard'
}

/**
 * Shows a specific project on the projectboard. Request made by the dropdown box.
 *
 * @param projectID the specific project to be shown.
 */
function showSpecific(projectID)
{
    let projectsBox = document.getElementById(`projectsBox`);
    let projectBox = document.getElementById(`projectBox`);
    projectBox.style.display = "block";
    projectsBox.style.display = "none";

    let elem = document.getElementById(projectID).innerHTML
    document.getElementById(`projectBox`).innerHTML = elem;

}

/**
 * Processes an approval selection request for an inactive project.
 *
 * @param projectID the ID of the inactive project.
 * @param approvalID the ID of the approval selection made.
 * @param projectCount the current position of the project on the project board. Used for the alternating design.
 */
function approvalSelect(projectID, approvalID, projectCount)
{
    let token = jQuery("#token").attr("name");

    jQuery.ajax(
        {
            data: {[token]: "1", task: "approvalSelect", format: "json", projectID: projectID, approvalID: approvalID},
            success: (result) =>
            {
                if (result.data === true)
                {
                    activateProject(projectID, projectCount)
                }
            },
            error: () => console.log('Failure to perform affirm(). Contact an dashboard if this failure persists.'),
        }
    );
}

/**
 * If project has been approved, this function will be called by approvalSelection.
 * This function will request the server to generate the HTML to display the newly approved project as an approved project.
 * The AJAX will receive this HTML and replace the old inactive project template with the active project template.
 *
 * @param projectID the ID of the approved project.
 * @param projectCount the current position of the project on the project board. Used for the alternating design.
 */
function activateProject(projectID, projectCount)
{
    let token = jQuery("#token").attr("name");

    jQuery.ajax(
        {
            data: {[token]: "1", task: "activeProjectTemplate", format: "raw", data: {projectID: projectID, projectCount: projectCount}},
            success: (result) => {
                document.getElementById(projectID).outerHTML = result
                document.getElementById(`projectBox`).innerHTML = result
            },
            error: () => console.log('Failure to perform activateProject(). Contact an dashboard if this failure persists.'),
        }
    );
}

/* Redirects */

function surveyRedirect(projectID)
{
    window.location = `?option=com_progresstool&view=survey&projectID=${projectID}`
}

function statsRedirect(projectID)
{
    window.location = `?option=com_progresstool&view=projectstats&projectID=${projectID}`
}

function settingsRedirect(projectID)
{
    window.location = `?option=com_progresstool&view=settings&projectID=${projectID}`
}

function resourceRedirect()
{
    window.location = `/oss-resources`
}