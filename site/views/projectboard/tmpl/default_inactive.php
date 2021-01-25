<?php defined('_JEXEC') or die; ?>

<div class="project" id="<?php echo $this->project->id; ?>">

    <div class="details" style="order: <?php echo $this->count % 2 ? 0 : 2; ?>;">
        <h1><?php echo $this->project->name; ?></h1>

        <p>
            These prerequisites should be discussed within your group at an early stage to gauge the viability of the project. Tick each question to
            indicate the points have been discussed and progress to the survey
        </p>

        <div class="selections">
            <?php foreach ($this->approvalQuestions as $question): ?>
                <label class="choice">
                    <input onclick="approvalSelect(<?php echo $this->project->id . ',' . $question->id . ',' . $this->count; ?>)"
                           type="checkbox" <?php echo array_key_exists($question->id, $this->selections[$this->project->id]) ? 'checked' : ''; ?>>
                    <span class="box">
                        <span class="text">
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