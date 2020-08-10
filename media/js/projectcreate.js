function getProjectData() {
    return {
        name: document.getElementById("name").value,
        description: document.getElementById("description").value
    }
}

function createProject() {
    let projectData = getProjectData();

    //console.log(one + " " + two)

    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: { [token]: "1", task: "createProject", format: "json", projectData: projectData },
        success: function(result, status, xhr) { success(result); },
        error: function() { console.log('ajax call failed'); },
    });
}

function success(result)
{
    // Todo not this type of redirect instead a result.redirect...
    window.location = 'index.php?option=com_progresstool&view=projectboard'//result.redirect;
}