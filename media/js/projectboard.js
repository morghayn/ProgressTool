function surveyRedirect(projectID)
{
    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: { [token]: "1", task: "openSurvey", format: "json", data: {projectID: projectID} },
        success: function(result, status, xhr) { success(result); },
        error: function() { console.log('ajax call failed'); }, // todo do not allow selection of 'choice'
    });
}

function success(result)
{
    window.location = result.data.redirect;
}


function approvalClick(projectID, approvalID)
{
    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: { [token]: "1", task: "approval", format: "json", data: {project: projectID, approvalID: approvalID} },
        success: function(result, status, xhr) { approvalClickSuccess(result, projectID, approvalID); },
        error: function() { console.log('ajax call failed'); }
    });
}

function approvalClickSuccess(result, projectID, approvalID) {
    // window.location = result.data.redirect;

    if(result.data.activated === true)
    {
        window.location = 'index.php?option=com_progresstool&view=projectboard'
    }
    else
    {
        // do nothing
    }

    /*
    if (result.data.selected == 1) {
        console.log("Selected");
    } else
    {
        console.log("Not selected");
    }
     */
}