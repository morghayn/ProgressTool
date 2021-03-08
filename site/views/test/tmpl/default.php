<?php defined('_JEXEC') or die; ?>

<div class="timeline">
    <div class="outer">
        <div class="inner">

            <div class="plot-overlay">
                <?php foreach ($this->plots as $plot): ?>
                    <div class="plot"
                         style="top: <?php echo $plot['y']; ?>%; left: calc(<?php echo $plot['x']; ?>% - 3rem); --colour: <?php echo $plot['colour_rgb']; ?>;">
                        <img src="<?php echo JURI::root() . $plot['icon_path']; ?>"
                             alt="<?php echo $plot['project_name']; ?>">
                        <span class="name"><?php echo $plot['project_name']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <img src="<?php echo JURI::root() . '/media/com_progresstool/icons/' . 'timeline-min.jpg'; ?>" alt="ECCO Timeline">

        </div>
    </div>
</div>
