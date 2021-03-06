<?php defined('_JEXEC') or die; ?>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>
    <?php echo $this->loadTemplate('modal'); ?>

    <table id="projectTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Project Name</th>
                <th>Creator's Username</th>
                <th>Creation Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->projects as $project): ?>
                <tr onclick="openModal('<?php echo $project->id; ?>')">
                    <td><?php echo $project->id; ?></td>
                    <td><?php echo $project->name; ?></td>
                    <td><?php echo $project->username; ?></td>
                    <td><?php echo $project->creation_date; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- CSRF Token -->
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>


<!-- Put this in a modal -->
<!-- <button id="delete" onclick="deleteProject(<?php echo $project->id; ?>)">*</button> -->