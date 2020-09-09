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

    document.getElementById(`projectBox`).innerHTML = getActiveProjectTemplate(projectID, 1);//document.getElementById(projectID).outerHTML;
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
            data: {[token]: "1", task: "projectboard.approvalSelect", format: "json", projectID: projectID, approvalID: approvalID},
            success: (result) =>
            {
                if (result.data === true)
                {
                    document.getElementById(projectID).outerHTML = getActiveProjectTemplate(projectID, projectCount)
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
function getActiveProjectTemplate(projectID, projectCount)
{
    let token = jQuery("#token").attr("name");
    let html = '';

    jQuery.ajax(
        {
            data: {[token]: "1", task: "getActiveProjectTemplate", format: "raw", projectID: projectID, projectCount: projectCount},
            async: false,
            success:
                function (result)
                {
                    html = result
                },
            error:
                function ()
                {
                    html = '<h2>Failure to perform activateProject(). Contact an administrator if this failure persists.</h2>'
                }
        }
    );

    return html;
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