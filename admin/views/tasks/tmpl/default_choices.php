<?php defined('_JEXEC') or die; ?>

<!-- Choices -->
<div id="choices">
    <table>
        <thead>
            <tr>
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