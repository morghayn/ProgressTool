<?php defined('_JEXEC') or die; ?>

<div id="ptModal" class="ptModal">
    <div class="ptModalContent">
        <div class="ptModalHeader">
            <span class="ptCloseModal">&times;</span>
            <h2>Select choice</h2>
        </div>
        <div id="ptTable">
            <table>
                <thead>
                    <tr style="background-color: #f08080;">
                        <th>ID</th>
                        <th>QuestionID</th>
                        <th>Choice</th>
                        <th>Weight</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->choices as $choice): ?>
                        <tr>
                            <td><?php echo $choice->id; ?></td>
                            <td><?php echo $choice->question_id; ?></td>
                            <td><?php echo $choice->choice; ?></td>
                            <td><?php echo $choice->weight; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
