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
        <?php endforeach; ?>
    </div>
</div>

<!-- Adding event listeners -->
<script>
    // Task
    document.querySelectorAll("[id^='tid-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                e =>
                {
                    focusTask(e.currentTarget)
                    focusTaskID(e.currentTarget.id.split('-')[1])
                },
                true
            )
        }
    )

    // Add choice click
    document.querySelectorAll("[id^='a-t-c-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                () => openModal(),
                true
            )
        }
    )

    // Update task logic (or) click
    document.querySelectorAll("[id^='u-t-l-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                e => logicToggle(e.currentTarget.id.split('-')[4]),
                true
            )
        }
    )

    // Choice click
    document.querySelectorAll("[id*='t-cid-']").forEach(e =>
        {
            e.addEventListener(
                "click",
                e =>
                {
                    focusChoiceID(e.currentTarget.id.split('-')[3])
                    focusChoice(e.currentTarget)
                },
                true
            )
        }
    )

    // Remove choice click
    document.querySelectorAll("[id*='r-t-c-']").forEach(
        e =>
        {
            e.addEventListener("click", () => removeChoice(), true)
        }
    )
</script>