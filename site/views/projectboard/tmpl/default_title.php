<?php defined('_JEXEC') or die; ?>

<div class="headC">

    <div class="titlC">
        <div class="titl">
            Project Board
        </div>

        <div class="projectSelection">
            <h2>Select Project</h2>
            <select onchange="this.options[this.selectedIndex].value > 0 ? showSpecific(this.options[this.selectedIndex].value) : showAll()">
                <option value="0">All</option>
                <?php foreach ($this->projects as $project): ?>
                    <option value="<?php echo $project->id; ?>">
                        <?php echo $project->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <button onclick="window.location = '?option=com_progresstool&view=projectcreate'" class="buttonCreate"></button>

</div>

