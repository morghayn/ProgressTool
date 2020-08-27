<?php defined('_JEXEC') or die; ?>

<div class="projectContainer" id="<?php echo $this->project->id; ?>">
    <div class="projectChest">

        <div class="projectApproval">
            <div class="projectTitle">
                <?php echo $this->project->name; ?>
            </div>

            <div class="projectCategory">
                (Not Activated)
            </div>

            <div class="approvalCheck">
                <?php foreach ($this->approvalQuestions as $question):
                    $param = $this->project->id . ',' . $question->id . ',' . $this->projectCount;
                    $checkStr =
                        array_key_exists($this->project->id, $this->approvalSelects)
                            ? array_key_exists($question->id, $this->approvalSelects[$this->project->id]) ? 'checked' : '' : '';
                    ?>

                    <label class="optionChest">
                        <input class="optionInput" onclick="approvalSelect(<?php echo $param; ?>)" type="checkbox" <?php echo $checkStr; ?>>
                        <span class="optionLabel">
                            <span class="option">
                                <?php echo $question->question; ?>
                            </span>
                        </span>
                    </label>

                <?php endforeach; ?>
            </div>
        </div>

        <div class="buttonChest">
            <button class="approvalButton" onclick="resourceRedirect()">
                Helpful Resources
            </button>
        </div>

    </div>
</div>