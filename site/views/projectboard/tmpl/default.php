<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

echo $this->loadTemplate('title');

if (!$this->projects):

    echo $this->loadTemplate('noprojects');

else:

    $this->projectCount = 0;
    foreach ($this->projects as $this->project):
        $activated = $this->project->activated == 1;
        $this->projectCount++;

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