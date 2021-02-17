<?php defined('_JEXEC') or die; ?>

<!-- Choices -->
<div id="choices" class="grouping">
    <h1>Choices</h1>
    <?php foreach ($this->task->choices as $choice): ?>
        <div style="border-color: <?php echo $this->colourHex; ?>; --hoverColour: <?php echo $this->colourRGB; ?>;"
             id="<?php echo 'choiceid-' . $choice->id; ?>" class="choice item">
            <h3>CID:<?php echo $choice->id; ?></h3>
            <h3>W:<?php echo $choice->weight; ?></h3>
            <button onclick="removeChoice('<?php echo $this->task->id . "','" . $choice->id; ?>')">Remove</button>
            <h2><?php echo $choice->choice; ?></h2>
        </div>
    <?php endforeach; ?>

    <button class="loose" onclick="openChoiceSelector()">Add Choice</button>
</div>