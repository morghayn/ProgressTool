<?php defined('_JEXEC') or die;

/**
 * Class ProgressToolModelDashboard
 *
 * Model for back-end dashboard functionality.
 *
 * @package ProgressTool
 * @subpackage admin
 * @since 0.3.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelDashboard extends JModelAdmin
{
    /**
     * Returns the countryID associated with countryString, else if not found returns 1 if not found.
     *
     * @param string $countryString the country name.
     * @return int the countryID.
     * @since 0.3.0
     */
    public function getCountryID($countryString)
    {
        $db = JFactory::getDbo();
        $getCountryID = $db->getQuery(true);

        $getCountryID
            ->select($db->quoteName('C.id'))
            ->from($db->quoteName('#__pt_country', 'C'))
            ->where($db->quoteName('C.country') . ' LIKE ' . $db->quote($countryString));

        $countryID = $db->setQuery($getCountryID)->loadResult();
        return is_null($countryID) ? 1 : $countryID;
    }

    /**
     * Retrieve a list of location specific questions.
     *
     * @param $country int country index used to get location specific questions.
     * @return mixed objectList containing the location specific questions.
     * @since 0.3.0
     */
    public function getQuestions($country)
    {
        $db = JFactory::getDbo();
        $getQuestions = $db->getQuery(true);

        $columns = array('Q.id', 'Q.question', 'CA.colour_hex', 'CA.colour_rgb');

        $getQuestions
            ->select($db->quoteName($columns))
            ->select('SUM(CH.weight) as total')
            ->from($db->quoteName('#__pt_question', 'Q'))
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON ' . $db->quoteName('Q.id') . ' = ' . $db->quoteName('CO.question_id'))
            ->innerjoin($db->quoteName('#__pt_question_choice', 'CH') . ' ON ' . $db->quoteName('Q.ID') . ' = ' . $db->quoteName('CH.question_id'))
            ->innerjoin($db->quoteName('#__pt_category', 'CA') . ' ON ' . $db->quoteName('Q.category_id') . ' = ' . $db->quoteName('CA.id'))
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($country))
            ->group($db->quoteName('Q.id'))
            ->order('Q.id ASC');

        return $db->setQuery($getQuestions)->loadObjectList();
    }

    /**
     * Retrieve a list of location specific choices. Additionally, to indicate whether a project has selected a choice, the project_id attribute has
     * is retrieved via a left join. If a selection has been made, the projectID will be present, else the field will return null.
     *
     * @param int $projectID project index for which selections will be retrieved
     * @param int $country country index used to get location specific choices.
     * @return array the choices grouped by their respective questions, with an attribute to indicate whether it has been selected or not.
     * @since 0.1.0
     */
    public function getChoices($country)
    {
        $db = JFactory::getDbo();
        $choices = $db->getQuery(true);

        $columns = array('CH.id', 'CH.question_id', 'CH.choice', 'CH.weight');

        $choices
            ->select($db->quoteName($columns))
            ->from($db->quoteName('#__pt_question_choice', 'CH'))
            ->innerjoin($db->quoteName('#__pt_question', 'Q') . ' ON CH.question_id = Q.id')
            ->innerjoin($db->quoteName('#__pt_question_country', 'CO') . ' ON Q.id = CO.question_id')
            ->where($db->quoteName('CO.country_id') . ' = ' . $db->quote($country));

        return $this->groupChoices($db->setQuery($choices)->loadObjectList());
    }

    /**
     * Takes in choices through parameters and returns an array of the choices grouped by question.
     *
     * @param mixed $rows the choice rows which are to be grouped.
     * @return array the choices grouped by question.
     * @since 0.2.6
     */
    public function groupChoices($rows)
    {
        $groupedChoices = array();

        foreach ($rows as $row)
        {
            // Grouping by questionID.
            $groupedChoices[$row->question_id][] = $row;
        }

        return $groupedChoices;
    }

    /**
     * Returns data attached to a specific choice.
     *
     * @param int $choiceID the choiceID of the choice in question.
     * @return mixed an associative array containing data of the choice in question.
     * @since 0.3.0
     */
    public function getChoice($choiceID)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select($db->quoteName('*'))
            ->from($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID));

        return $db->setQuery($query)->loadAssoc();
    }

    public function getQuestionID($choiceID)
    {
        $db = JFactory::getDbo();
        $getQuestionID = $db->getQuery(true);

        $getQuestionID
            ->select($db->quoteName('question_id'))
            ->from($db->quoteName('#__pt_question_choice'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($choiceID))
            ->setLimit(1);

        return $db->setQuery($getQuestionID)->loadResult();
    }

    /**
     * Overriding SAVE method
     * @param array $data (data from form)
     */
    public function save($data)
    {
        $user = JFactory::getUser();
        $userID = $user->id;
        $name = $data['name'];
        $description = $data['description'];
        $type = $data['type'];

        $db = JFactory::getDbo();
        $insert = $db->getQuery(true);

        $columns = array('user_id', 'name', 'description', 'type_id');
        $values = array($userID, $db->quote($name), $db->quote($description), $db->quote($type));

        $insert
            ->insert($db->quoteName('#__pt_project'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        return $db->setQuery($insert)->execute();

        /* Try using JTable here
        // retrieve all table objects needed to store form data
        $tbl_employer = $this->getTable('Employer');
        $tbl_contact = $this->getTable('Contact', 'RgtMyraTable', array());

        if($tbl_employer){
            $tbl_employer->industries_id = $data['industry'];
        }
        else{
            $this->setError("Error getting employer table");
            return false;
        }

        // Store the data.
        if (!$tbl_employer->save($data))
        {
            $this->setError("Error saving into employer table");
            return false;
        }
        */
    }

    /*
     * Method to get a table object, load it if necessary.
     *
     * @param string $type The table name. Optional.
     * @param string $prefix The class prefix. Optional.
     * @param array $config Configuration array for model. Optional.
     *
     * @return  JTable  A JTable object
     *
     * @since   1.6
     */
    /* // TODO: probably need
    public function getTable($type = 'project', $prefix = 'pt_', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    */

    /**
     * Method to get the record form.
     *
     * @param array $data Data for the form.
     * @param boolean $loadData True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed    A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm(
            'com_progresstool.dashboard',
            'add-image',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form)) {
            $errors = $this->getErrors();
            throw new Exception(implode("\n", $errors), 500);
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     * As this form is for add, we're not prefilling the form with an existing record
     * But if the user has previously hit submit and the validation has found an error,
     *   then we inject what was previously entered.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        return JFactory::getApplication()->getUserState('com_progresstool.edit.dashboard.data', array());
    }

    /**
     * Method to get the script that have to be included on the form
     * This returns the script associated with projectcreate field name validation
     *
     * @return string    Script files
     */
    public function getScript()
    {
        return 'media/com_progresstool/forms/projectcreate.js';
    }
}