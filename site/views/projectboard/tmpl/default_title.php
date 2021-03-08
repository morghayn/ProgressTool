<?php defined('_JEXEC') or die; ?>

<div class="titleContainer" id="titleContainer">
    <button id="create">Create Project</button>
    <h1 id="title">Project Board</h1>

    <?php if ($this->projects): // Only display project selector if user has projects ?>
        <label for="projectSelect">Select Project</label>
        <select name="projectSelect" id="projectSelect">
            <option value="" disabled selected hidden>Select Project</option>
            <option value="0">All</option>
            <?php foreach ($this->projects as $project): ?>
                <option value="<?php echo $project->id; ?>">
                    <?php echo $project->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php else: // Adjusts style to accommodate the absence of project selector ?>
        <script>accommodateNoSelector();</script>
    <?php endif; ?>
</div>

<script>attachEventListeners();</script>

<?php if (!$this->projects): // If user does not have projects ?>
    <p class="abstract">
        Welcome to the Progress Tool. This tool will use a survey to measure what stage of development your Community
        Energy project is at and will provide guidance on what next steps to take.<br><br>

        To begin, click the green button on the top right corner to create a project entry. After adding details about the project and selecting which
        type of Renewable Energy it employs click “Submit”. The tool will save your project details for future updates.<br><br>

        The survey consists of 26 questions relating to different stages of a Community Energy project. Please select all options that apply to your
        project, feel free to choose more than one option.<br><br>

        The score tallied from the survey responses is used to populate a spider diagram, describing the progress under each heading from the
        <a href="/timeline">ECCO timeline</a> (<b class="people">People</b>, <b class="technology">Technology</b> and <b class="finance">Finance</b>).
    </p>
<?php endif; ?>
