function checker(projectID, choiceID) { // todo rename tasks etc.
    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: { [token]: "1", task: "persistClick", format: "json", data: {projectID: projectID, choiceID: choiceID} },
        success: function(result, status, xhr) { success(result); },
        error: function() { console.log('ajax call failed'); }, // todo do not allow selection of 'choice'
    });
}

function success(result)
{
    document.getElementById(`score_${result.data.id}`).innerHTML = result.data.score;
    console.log(result.data)
    //deselector(result);
}

function deselector(choices) {
    /**
     *     TODO deselect check boxes passed through
     */
    //var token = jQuery("#token").attr("name");
}