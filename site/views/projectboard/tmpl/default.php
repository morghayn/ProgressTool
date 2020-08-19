<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

echo $this->loadTemplate('title');

echo $this->loadTemplate('dropdown');

if (!$this->projects):

    echo $this->loadTemplate('noprojects');

else:

    foreach ($this->projects as $this->project):
        $activated = $this->project->activated == 1;

        if ($activated)
        {
            echo $this->loadTemplate('active');
        }
        else
        {
            echo $this->loadTemplate('inactive');
        }

    endforeach;

endif;

?>

<div id="test"></div>

<!--div class="masterChest" style="border: none; width: 55px;">
    <button onclick="location.href = '?option=com_progresstool&view=projectcreate'" class="cornerButton"></button>
</div-->