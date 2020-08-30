/**
 * Redirects back to the ProjectBoard
 */
function redirectProjectBoard()
{
    window.location = '?option=com_progresstool&view=projectboard'
}

/**
 * Requests the server to create a new project using data from the form.
 */
function createProject()
{
    let token = jQuery("#token").attr("name");
    let projectData = getProjectData();

    jQuery.ajax(
        {
            data: {[token]: "1", task: "createProject", format: "json", projectData: projectData},
            success: () => window.location = '?option=com_progresstool&view=projectboard',
            error: function ()
            {
                console.log('ajax call failed');
            },
        }
    );
}

/**
 * Retrieves project data from the form.
 *
 * @returns {{name: *, projectType: *, description: *}} an array consisting of the project's name and description.
 */
function getProjectData()
{
    return {
        name: document.getElementById("name").value,
        description: document.getElementById("description").value,
        type: document.getElementById("type").value
    }
}