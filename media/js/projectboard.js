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


function preliminaryClick(projectID, preliminaryID)
{
    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: { [token]: "1", task: "preliminary", format: "json", data: {project: projectID, preliminaryID: preliminaryID} },
        success: function(result, status, xhr) { preliminaryClickSuccess(result, projectID, preliminaryID); },
        error: function() { console.log('ajax call failed'); }
    });
}

function preliminaryClickSuccess(result, projectID, preliminaryID) {
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
