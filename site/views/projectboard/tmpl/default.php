<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

echo $this->loadTemplate('title');

if (!$this->projects):

    echo $this->loadTemplate('noprojects');

else:

    $this->projectCount = 0;
    foreach ($this->projects as $this->project):
        $this->projectCount++;

        if ($this->project->activated == 1)
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