function surveyRedirect(projectID)
{
    window.location = `?option=com_progresstool&view=survey&projectID=${projectID}`
}

function statsRedirect(projectID)
{
    window.location = `?option=com_progresstool&view=projectstats&projectID=${projectID}`
}

function resourceRedirect()
{
    window.location = `/oss-resources`
}

function affirm(projectID, approvalID, projectCount)
{
    var token = jQuery("#token").attr("name");
    jQuery.ajax(
        {
            data: {[token]: "1", task: "approval", format: "json", data: {project: projectID, approvalID: approvalID}},
            success: (result) =>
            {
                if (result.data)
                {
                    activateProject(projectID, projectCount)
                }
            },
            error: () => console.log('Failure to perform affirm(). Contact an administrator if this failure persists.'),
        }
    );
}

function activateProject(projectID, projectCount)
{
    jQuery.ajax(
        {
            data: {[token]: "1", task: "abc", format: "raw", data: {projectID: projectID, projectCount: projectCount}},
            success: (result) => document.getElementById(projectID).outerHTML = result,
            error: () => console.log('Failure to perform activateProject(). Contact an administrator if this failure persists.'),
        }
    );
}