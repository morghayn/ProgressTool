<?php

defined('_JEXEC') or die;

$id = $this->project->id;
$title = $this->project->name;
$description = $this->project->description;

?>

<div class="projectContainer" id="<?php echo $id; ?>">

    <div class="projectChest">

        <div class="projectApproval">
            <div class="projectTitle">
                <?php echo $title; ?>
            </div>

            <div class="projectCategory">
                (Not Activated)
            </div>

            <div class="approvalCheck">
                <?php
                foreach ($this->approvalQuestions as $this->question):
                    echo $this->loadTemplate('option');
                endforeach;
                ?>
            </div>
        </div>

        <div class="buttonChest">
            <button class="approvalButton" onclick="resourceRedirect()">Helpful Resources</button>
        </div>

    </div>
</div>