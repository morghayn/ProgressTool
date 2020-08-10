function surveyRedirect(projectID)
{
    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: { [token]: "1", task: "surveyRedirect", format: "json", data: {projectID: projectID} },
        success: function(result, status, xhr) { success(result); },
        error: function() { console.log('ajax call failed'); }, // todo do not allow selection of 'choice'
    });
}

function success(result)
{
    window.location = result.data.redirect;
}