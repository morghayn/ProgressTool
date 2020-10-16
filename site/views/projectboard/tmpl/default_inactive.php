<?php

defined('_JEXEC') or die;
$alt = $this->projectCount % 2 == 0 ? 2 : 0;

?>

<div class="projectChest" id="<?php echo $this->project->id; ?>">

    <div class="projectApproval" style="order: <?php echo $alt; ?>;">
        <div class="projectTitle">
            <?php echo $this->project->name; ?>
        </div>

        <div class="projectType">
            These prerequisites should be discussed within your group at an early stage to gauge the viability of the project. Tick each question to
            indicate the points have been discussed and progress to the survey
        </div>

        <div class="approvalCheck">
            <?php foreach ($this->approvalQuestions as $question):
                $param = $this->project->id . ',' . $question->id . ',' . $this->projectCount;
                $checkStr =
                    array_key_exists($this->project->id, $this->projectApprovalSelections)
                        ? array_key_exists($question->id, $this->projectApprovalSelections[$this->project->id])
                        ? 'checked'
                        : ''
                        : '';
                ?>

                <label class="optionChest" style="--outlineColour: #ffffff; --optionColour: #ffffff;">
                    <input class="optionInput" onclick="approvalSelect(<?php echo $param; ?>)" type="checkbox" <?php echo $checkStr; ?>>
                    <span class="optionLabel" style="--labelColour: 255, 255, 255; color: #ffffff;">
                            <span class="option" style="color: #ffffff;">
                                <?php echo $question->question; ?>
                            </span>
                        </span>
                </label>

            <?php endforeach; ?>
        </div>
    </div>

    <div class="gap"></div>

    <div class="buttonChest" style="order: <?php echo $alt == 2 ? 0 : 2; ?>;">
        <button class="approvalButton" onclick="window.location = `/oss-resources`">
            Helpful Resources
        </button>
    </div>

</div>