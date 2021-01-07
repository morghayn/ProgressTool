<?php defined('_JEXEC') or die; ?>
<input id="token"
       type="hidden"
       name="<?php echo JSession::getFormToken(); ?>"
       value="1"/>

<?php echo $this->loadTemplate('sidebar'); ?>

<div id="main">
    <span class="openNavigation" onclick="openNav()">&#9776; navigation</span>
    <?php echo $this->loadTemplate('modal'); ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Project Name</th>
                <th>Creation Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->projects as $project): ?>
                <tr onclick="openModal()">
                    <td><?php echo $project->id; ?></td>
                    <td><?php echo $project->user_id; ?></td>
                    <td><?php echo $project->name; ?></td>
                    <td><?php echo $project->creation_date; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Put this in a modal -->
<!-- <button id="delete" onclick="deleteProject(<?php echo $project->id; ?>)">*</button> -->