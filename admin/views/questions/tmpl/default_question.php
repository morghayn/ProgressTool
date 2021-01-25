<?php defined('_JEXEC') or die; ?>

<?php // For Icon
$filepath = $this->question->filepath;
$imageAttributes = $filepath ? $this->question->image_attributes : '';
?>

<div class="question" style="border-color: <?php echo $this->colourHex; ?>;">
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>;"
         onclick="window.open('?option=com_progresstool&view=questionEditor&questionID=<?php echo $this->question->id; ?>')">
        <h1><?php echo $this->count . '. ' . $this->question->question; ?></h1>
    </div>

    <div>
        <?php if ($filepath): ?>
            <div class="iconChest" style="<?php echo $imageAttributes; ?>">
                <figure style="width: 100%; height: 100%; margin: 0;">
                    <img src="<?php echo JURI::root() . $filepath; ?>" alt="Progress Tool Icon">
                </figure>
            </div>
        <?php endif; ?>

        <div class="choices">
            <?php foreach ($this->choices[$this->question->id] as $this->choice): ?>
                <?php echo $this->loadTemplate('choice'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

