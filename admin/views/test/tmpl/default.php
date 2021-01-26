<?php defined('_JEXEC') or die; ?>

<?php foreach ($this->categories as $category): ?>
    <div class="category" style="--backgroundColour: <?php echo $category->colour_rgb; ?>">
        <h1 style="text-align: center;"><?php echo $category->category; ?><br></h1>

        <?php foreach ($this->progresses as $progress): ?>
            <div class="project"
            style="margin-left: <?php echo $progress[$category->id - 1]; ?>%; --backgroundColour: <?php echo $category->colour_rgb; ?>">

            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>