<?php defined('_JEXEC') or die; ?>

<?php
// For Icon
$filepath = $this->question->filepath;
$imageAttributes = $filepath ? $this->question->image_attributes : '';

$userScore = 0;
foreach ($this->choices[$this->questionID] as $choice):
    $userScore += is_null($choice->project_id) ? 0 : $choice->weight;
endforeach;
?>

<div class="question" style="border-color: <?php echo $this->colourHex; ?>">
    <div class="heading" style="background-color: <?php echo $this->colourHex; ?>;" onclick="toggleQuestion('<?php echo $this->questionID; ?>')">
        <h1><?php echo $this->count . '. ' . $this->question->question; ?></h1>
        <h2>Score <span id="qsid-<?php echo $this->questionID; ?>"><?php echo $userScore; ?></span>/<?php echo $this->score; ?></h2>
    </div>

    <div id="qid-<?php echo $this->questionID; ?>" style="display: <?php echo $userScore == $this->question->score ? 'none' : 'block'; ?>">
        <?php if ($filepath): ?>
            <div class="iconChest" style="<?php echo $imageAttributes; ?>">
                <figure style="width: 100%; height: 100%; margin: 0;">
                    <img src="<?php echo JURI::root() . $filepath; ?>" alt="Progress Tool Icon">
                </figure>
            </div>
        <?php endif; ?>

        <div class="choices">
            <?php
            foreach ($this->choices[$this->questionID] as $this->choice):
                $this->choiceID = $this->choice->id;
                $this->isChecked = is_null($this->choice->project_id) ? '' : 'checked';
                echo $this->loadTemplate('choice');
            endforeach;
            ?>
        </div>
    </div>
</div>
