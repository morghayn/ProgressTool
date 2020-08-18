function surveyRedirect(projectID)
{
    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: {[token]: "1", task: "openSurvey", format: "json", data: {projectID: projectID}},
        success: function (result, status, xhr)
        {
            window.location = result.data.redirect;
        },
        error: function ()
        {
            console.log('ajax call failed');
        }, // todo do not allow selection of 'choice'
    });
}

function approvalClick(projectID, approvalID)
{
    var token = jQuery("#token").attr("name");
    jQuery.ajax(
        {
            data: {[token]: "1", task: "approval", format: "json", data: {project: projectID, approvalID: approvalID}},
            success: (result) =>
            {
                if (result.data)
                {
                    activateProject(projectID)
                }
            },
            error: () => console.log('Failure to perform activateProject(). Contact an administrator if this failure persists.'),
        }
    );
}

function activateProject(projectID)
{
    jQuery.ajax(
        {
            data: {[token]: "1", task: "abc", format: "raw", data: {projectID: projectID}},
            success: (result) => document.getElementById(projectID).outerHTML = result,
            error: () => console.log('Failure to perform activateProject(). Contact an administrator if this failure persists.'),
        }
    );
}