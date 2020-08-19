<?php

defined('_JEXEC') or die;

?>

<select name="projects"> <!--id="project"-->
    <?php
    foreach ($this->projects as $project):
        echo '<option value="volvo">' . $project->name . '</option>';
    endforeach;
    ?>
</select>