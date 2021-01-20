<?php defined('_JEXEC') or die; ?>
<?php echo $this->sidebar->render(); ?>

<input id="token"
       type="hidden"
       name="<?php echo JSession::getFormToken(); ?>"
       value="1"/>

<div id="main">
    <span class="openNavigation" onclick="openNav()">&#9776; navigation</span>
    <?php echo $this->loadTemplate('modal'); ?>
    <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Search by project or username..">

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


<!-- Put this in a modal -->
<!-- <button id="delete" onclick="deleteProject(<?php echo $project->id; ?>)">*</button> -->