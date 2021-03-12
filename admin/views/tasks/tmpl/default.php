<?php defined('_JEXEC') or die; ?>

<!-- CSRF Token -->
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<!-- Storing countryID -->
<script>countryID = <?php echo $this->countryID; ?></script>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>
    <?php echo $this->loadTemplate('modal'); ?>

    <div class="tasks">
        <?php foreach ($this->tasks as $this->task): ?>
            <?php $this->colourRGB = $this->categories[$this->task->category_id - 1]->colour_rgb; ?>
            <?php $this->colourHex = $this->categories[$this->task->category_id - 1]->colour_hex; ?>
            <?php echo $this->loadTemplate('task'); ?>
            <?php //break; ?>

            <!-- Adding event listeners -->
            <script>
                // Add choice click
                document
                    .getElementById('<?php echo 'a-c-t-' . $this->task->id; ?>')
                    .addEventListener("click", () =>
                    {
                        focusTaskID('<?php echo $this->task->id; ?>')
                        focusTask('<?php echo 't-' . $this->task->id; ?>')
                        openModal()
                    })

                // Update task logic (or) click
                document
                    .getElementById('<?php echo 'u-t-' . $this->task->id . '-l-0'; ?>')
                    .addEventListener("click", () =>
                    {
                        focusTaskID('<?php echo $this->task->id; ?>')
                        focusTask('<?php echo 't-' . $this->task->id; ?>')
                        logicToggle(0)
                    })

                // Update task logic (and) click
                document
                    .getElementById('<?php echo 'u-t-' . $this->task->id . '-l-1'; ?>')
                    .addEventListener("click", () =>
                    {
                        focusTaskID('<?php echo $this->task->id; ?>')
                        focusTask('<?php echo 't-' . $this->task->id; ?>')
                        logicToggle(1)
                    })

                <?php foreach ($this->task->choices as $choice): ?>
                    // Remove choice click
                    document
                        .getElementById('<?php echo 'r-t-' . $this->task->id . '-c-' . $choice->id; ?>')
                        .addEventListener("click", () =>
                        {
                            focusTaskID('<?php echo $this->task->id; ?>')
                            focusTask('<?php echo 't-' . $this->task->id; ?>')
                            focusChoiceID('<?php echo $choice->id; ?>')
                            focusChoice('<?php echo 't-' . $this->task->id . '-c-' . $choice->id; ?>')
                            removeChoice()
                        })
                <?php endforeach; ?>
            </script>
        <?php endforeach; ?>
    </div>
</div>