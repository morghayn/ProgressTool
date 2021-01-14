<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolControllerSurvey
 *
 * Handling JSON responses for AJAX requests client-side
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.1.7
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolControllerSurvey extends JControllerLegacy
{
    /**
     * Returns JSON response for a survey selection.
     *
     * @since 0.1.7
     */
    public function surveySelect()
    {
        JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

        $input = JFactory::getApplication()->input;
        $data = $input->get('data', array(), 'ARRAY');
        $projectID = $data['projectID'];
        $choiceID = $data['choiceID'];

        JLoader::register('Auth', JPATH_BASE . '/components/com_progresstool/helpers/Auth.php');
        Auth::authorize($projectID);

        $model = parent::getModel('survey');
        $opposingProjectChoices = array();
        $isSelected = $model->isSelected($projectID, $choiceID);
        $choice = $model->getChoice($choiceID);

        if ($isSelected)
        {
            $model->deselectProjectChoice($projectID, $choice->id);
        }
        else
        {
            $model->selectProjectChoice($projectID, $choice->id);

            $opposingProjectChoices = $model->getOpposingProjectChoices(
                $choice->question_id,
                $projectID,
                $choice->weight
            );

            foreach ($opposingProjectChoices as $opposingProjectChoice)
            {
                $model->deselectProjectChoice($projectID, $opposingProjectChoice);
            }
        }

        $projectQuestionScore = $model->getProjectQuestionScore($choice->question_id, $projectID);
        $isQuestionComplete = $model->isQuestionComplete($choice->question_id, $projectQuestionScore);

        echo new JResponseJson(
            array(
                "isSelected" => !$isSelected,
                "questionID" => $choice->question_id,
                "projectQuestionScore" => $projectQuestionScore,
                "isQuestionComplete" => $isQuestionComplete,
                "opposingProjectChoices" => $opposingProjectChoices
            )
        );
    }
}