<?php

defined('_JEXEC') or die;

$id = $this->project->id;
$name = $this->project->name;
$description = $this->project->description;

?>

<div class="masterChest" id="<?php echo $id; ?>">

    <div class="headingChest">
        <div class="heading"><?php echo $name; ?> :: Not Activated</div>
    </div>

    <div class="optionsChest">

        <?php
        foreach ($this->approvalQuestions as $this->question):
            echo $this->loadTemplate('option');
        endforeach;
        ?>

        <div class="approvalButtonChest">
            <button href="something" class="approvalButton">Helpful Resources</button>
        </div>

    </div>
</div>