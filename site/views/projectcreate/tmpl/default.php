<?php defined('_JEXEC') or die; ?>

<?php echo '<input id="token" type="hidden" name="' . JSession::getFormToken() . '" value="1" />'; ?>

<div class="projectForm">
    <label for="name">Project Name</label>
    <input type="text" placeholder="Project Name" id="name"/>

    <label for="description">Project Description</label>
    <textarea placeholder="Project Description" id="description"></textarea>

    <label for="projectType">Choose a project type:</label>
    <select id="projectType" name="projectType">
        <option value="geothermal">Geothermal Energy</option>
        <option value="solar">Solar Energy</option>
        <option value="wind">Wind Energy</option>
        <option value="hydropower">Hydropower</option>
        <option value="other">Other</option>
    </select>

    <button class="buttonSubmit" onclick="createProject()">
        Submit
    </button>
</div>