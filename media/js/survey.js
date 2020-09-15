function timelineRedirect(categoryID, projectID, countryID)
{
    let token = jQuery("#token").attr("name");

    window.location.href =
        `?option=com_progresstool` +
        `&view=survey` +
        `&task=timelineredirect.redirect` +
        `&` + [token] + `=1` +
        `&projectID=${projectID}` +
        `&categoryID=${categoryID}` +
        `&countryID=${countryID}`;
}

function opensesame(boxName)
{
    let x = document.getElementById(boxName);
    if (x.style.display === "none")
    {
        x.style.display = "block";
    } else
    {
        x.style.display = "none";
    }
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
                    updateQuestionScore(result.data.questionID, result.data.userScore, result.data.isComplete);
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
function updateQuestionScore(questionID, score, isComplete)
{
    let elementID = `score_${questionID}`;
    let element = document.getElementById(elementID)

    element.innerHTML = score;
    if (isComplete)
    {
        opensesame(`cC${questionID}`)
    }
}