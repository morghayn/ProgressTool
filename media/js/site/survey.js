function timelineRedirect(categoryID, projectID, countryID)
{
    let token = jQuery("#token").attr("name");

    window.open(
        `?option=com_progresstool` +
        `&view=survey` +
        `&task=timelineredirect.redirect` +
        `&` + [token] + `=1` +
        `&projectID=${projectID}` +
        `&categoryID=${categoryID}` +
        `&countryID=${countryID}`
    );
}

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
            data: {[token]: "1", task: "survey.surveySelect", format: "json", data: {projectID: projectID, choiceID: choiceID}},
            success:
                function (result, status, xhr)
                {
                    console.log(result.data);
                    updateQuestionScore(result.data.questionID, result.data.projectQuestionScore, result.data.isQuestionComplete);
                    deselectChoices(result.data.opposingProjectChoices)
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
 * @param questionID
 * @param projectQuestionScore
 * @param isQuestionComplete
 */
function updateQuestionScore(questionID, projectQuestionScore, isQuestionComplete)
{
    document.getElementById(`qsid-${questionID}`).innerHTML = projectQuestionScore;

    if (isQuestionComplete)
    {
        toggleQuestion(questionID)
    }
}

function deselectChoices(opposingProjectChoices)
{
    opposingProjectChoices.forEach(
        opposingProjectChoice =>
            document.getElementById(`qcid-${opposingProjectChoice}`).checked = false
    );
}

function toggleQuestion(questionID)
{
    let content = document.getElementById(`qid-${questionID}`)
    content.style.display = (content.style.display === "none" ? "block" : "none")
}