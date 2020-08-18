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
            data: {[token]: "1", task: "abc", format: "raw"},
            success:
                function (result, status, xhr)
                {
                    //console.log(result);

                    document.getElementById("test").innerHTML = result;
                    if (result.data === true)
                    {
                        window.location = 'index.php?option=com_progresstool&view=projectboard'
                    }
                }
            ,
            error:
                function ()
                {
                    console.log('Failure to perform approvalClick(). Contact an administrator if this failure persists.');
                }
        }
    );
    /*
    jQuery.ajax(
        {
            data: {[token]: "1", task: "approval", format: "json", data: {project: projectID, approvalID: approvalID}},
            success:
                function (result, status, xhr)
                {
                    if (result.data === true)
                    {
                        window.location = 'index.php?option=com_progresstool&view=projectboard'
                    }
                }
            ,
            error:
                function ()
                {
                    console.log('Failure to perform approvalClick(). Contact an administrator if this failure persists.');
                }
        }
    );
     */
}