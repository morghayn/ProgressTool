/**
 * Processes a survey choice selection request.
 *
 * @param projectID the ID of the current project.
 * @param choiceID the ID of the choice selected.
 */
function surveySelect(projectID, choiceID)
{
    let token = jQuery("#token").attr("name");

    jQuery.ajax(
        {
            data: {[token]: "1", task: "surveySelect", format: "json", data: {projectID: projectID, choiceID: choiceID}},
            success:
                function (result, status, xhr)
                {
                    updateQuestionScore(result.data.id, result.data.score);
                },
            error:
                function ()
                {
                    console.log('ajax call failed');
                },
        }
    );
}

/**
 * Updates score box of the question parent of the choice selected.
 *
 * @param id the ID of the question, parent of the choice selected.
 * @param score the updated score.
 */
function updateQuestionScore(id, score)
{
    let elementID = `score_${id}`;
    let element = document.getElementById(elementID)

    element.innerHTML = score;
}