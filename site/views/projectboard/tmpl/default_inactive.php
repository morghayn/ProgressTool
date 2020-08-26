<?php

defined('_JEXEC') or die;

$id = $this->project->id;
$name = $this->project->name;
$description = $this->project->description;

?>

<div class="testChest" id="<?php echo $id; ?>">

    <div class="projectChest" style="padding: 0;">

        <!--
        <div class="projectTitle">
            <div class="heading"><?php //echo $name; ?> :: Not Activated</div>
        </div>
        -->


        <div class="projectInfo">
            <div class="testApproval">
                <?php
                foreach ($this->approvalQuestions as $this->question):
                    echo $this->loadTemplate('option');
                endforeach;
                ?>
            </div>
        </div>

        <div class="buttonsChest">
            <div class="approvalButtonChest">
                <button href="something" class="approvalButton">Helpful Resources</button>
            </div>
        </div>

    </div>
</div>