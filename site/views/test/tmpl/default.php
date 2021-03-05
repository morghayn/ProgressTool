<?php defined('_JEXEC') or die; ?>

<div class="timeline">
    <div class="outer">
        <div class="inner">

            <div class="overlay">
                <?php foreach ($this->plots as $plot): ?>
                        <div class="project"
                             style="top: <?php echo $plot[0]; ?>%; left: calc(<?php echo $plot[1]; ?>% - 3rem); --backgroundColour: <?php echo $plot[2]; ?>;">P</div>
                    <?php //TODO echo $category->colour_rgb; ?>
                <?php endforeach; ?>
            </div>

            <img src="<?php echo JURI::root() . '/media/com_progresstool/icons/' . 'timeline-min.jpg'; ?>" alt="ECCO Timeline">

        </div>
    </div>
</div>
