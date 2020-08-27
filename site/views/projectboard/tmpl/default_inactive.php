<?php defined('_JEXEC') or die; ?>
<?php $title = $this->project->name; ?>
<?php $id = $this->project->id; ?>

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
                <?php foreach ($this->approvalQuestions as $question):
                    $param = $id . ',' . $question->id . ',' . $this->projectCount;
                    $isChecked = array_key_exists($question->id, $this->approvalSelects[$id]);
                    $checkStr = $isChecked ? 'checked' : '';
                    ?>

                    <label class="optionChest">
                        <input class="optionInput" onclick="affirm(<?php echo $param; ?>)" type="checkbox" <?php echo $checkStr; ?>>
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