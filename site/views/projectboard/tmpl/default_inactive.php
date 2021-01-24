<?php defined('_JEXEC') or die; ?>

<div class="project" id="<?php echo $this->project->id; ?>">

    <div class="approval" style="order: <?php echo $this->count % 2 ? 0 : 2; ?>;">
        <div class="title"><?php echo $this->project->name; ?></div>
        <div class="type">
            These prerequisites should be discussed within your group at an early stage to gauge the viability of the project. Tick each question to
            indicate the points have been discussed and progress to the survey
        </div>
        <div class="approvalCheck">
            <?php foreach ($this->approvalQuestions as $question):
                $param = $this->project->id . ',' . $question->id . ',' . $this->count;
                // TODO: fix this
                $checkStr =
                    array_key_exists($this->project->id, $this->projectApprovalSelections)
                        ? array_key_exists($question->id, $this->projectApprovalSelections[$this->project->id])
                        ? 'checked'
                        : ''
                        : '';
                ?>
                <label class="choice" style="--outlineColour: #ffffff; --optionColour: #ffffff;">
                    <input onclick="approvalSelect(<?php echo $param; ?>)" type="checkbox" <?php echo $checkStr; ?>>
                    <span class="box" style="--labelColour: 255, 255, 255; color: #ffffff;">
                        <span class="text" style="color: #ffffff;">
                            <?php echo $question->question; ?><span class="disclaimer">*</span>
                        </span>
                    </span>
                </label>
            <?php endforeach; ?>
            <p class="disclaimer">The survey will not be available until you have checked these boxes.</p>
        </div>
    </div>

    <div class="buttons" style="order: <?php echo $this->count % 2 ? 2 : 0; ?>;">
        <button class="resources" onclick="window.location = `/oss-resources`">Helpful Resources</button>
    </div>

</div>