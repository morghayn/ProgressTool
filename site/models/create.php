<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolModelCreate
 *
 * Model for front-end project creation functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.5.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolModelCreate extends JModelAdmin
{
    /**
     * Retrieves the form.
     *
     * @param array $data
     * @param boolean $loadData true if the form is to load its own data, false if not
     * @return mixed JForm object on success, false on failure
     * @throws Exception
     * @since 0.5.0
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_progresstool.create',
            'project',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form))
        {
            $errors = $this->getErrors();
            throw new Exception(implode("\n", $errors), 500);
        }

        return $form;
    }

    /**
     * Retrieve data to be injected into form.
     * This is used for instance when a user encounters a validation error.
     *
     * @return  mixed The data for the form
     * @since   0.5.0
     */
    protected function loadFormData()
    {
        return JFactory::getApplication()->getUserState('com_progresstool.create.data', array());
    }

    /**
     * Creates a new project entry using the data provided.
     *
     * @param array $userID
     * @param $name
     * @param $description
     * @param $type
     * @param $groupID
     * @return bool|mixed
     * @since 0.5.0
     */
    public function create($userID, $name, $description, $type, $groupID)
    {
        $db = JFactory::getDbo();
        $insert = $db->getQuery(true);

        $columns = array('user_id', 'group_id', 'name', 'description', 'type_id', 'creation_date');
        $values = array($userID, $db->quote($groupID), $db->quote($name), $db->quote($description), $db->quote($type), 'NOW()');

        $insert
            ->insert($db->quoteName('#__pt_project'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        return $db->setQuery($insert)->execute();
    }

    // TODO: Document
    public function getGroupsQuery($userID)
    {
        return (
            'SELECT CG.id, CG.name ' .
            'FROM #__community_groups AS CG ' .
            'INNER JOIN #__community_groups_members AS CGM ON CG.id = CGM.groupid ' .
            'WHERE CGM.memberid = ' . $userID . ' AND CGM.permissions = 1 '
        );
    }
}