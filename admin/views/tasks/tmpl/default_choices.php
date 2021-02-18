<?php defined('_JEXEC') or die; ?>

<!-- Choices -->
<div id="choices">
    <table>
        <thead>
            <tr style="background-color: <?php echo $this->colourHex; ?>;">
                <th>CID</th>
                <th>Weight</th>
                <th>Choice</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->task->choices as $choice): ?>
                <tr id="<?php echo 'choiceid-' . $choice->id; ?>">
                    <td><?php echo $choice->id; ?></td>
                    <td><?php echo $choice->weight; ?></td>
                    <td><?php echo $choice->choice; ?></td>
                    <td>
                        <button onclick="removeChoice('<?php echo $this->task->id . "','" . $choice->id; ?>')">
                            Remove
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!--<h1>Choices</h1>-->

<!--<tr onclick="addChoice('<?php echo $choice->id; ?>')">-->
<!--<h3>CID:<?php //echo $choice->id; ?></h3>
                <h3>W:<?php //echo $choice->weight; ?></h3>
                <h2><?php //echo $choice->choice; ?></h2>-->

<!--<div style="border-color: <?php //echo $this->colourHex; ?>; --hoverColour: <?php //echo $this->colourRGB; ?>;"
             id="<?php //echo 'choiceid-' . $choice->id; ?>" class="choice item">-->

<!--<button onclick="removeChoice('<?php //echo $this->task->id . "','" . $choice->id; ?>')">Remove</button>-->
<!--</div>-->