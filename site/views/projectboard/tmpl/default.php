<?php defined('_JEXEC') or die;?>
<?php echo $this->loadTemplate('title'); ?>
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php if ($this->projects): // If user has projects... ?>
    <div id="projectViewer"><!-- For displaying a selected project --></div>
    <div id="projects" class="projects">
        <?php
        $this->projectCount = 0;
        foreach ($this->projects as $this->project):
            $this->projectCount++;
            echo $this->project->activated == 1 ? $this->loadTemplate('active') : $this->loadTemplate('inactive');
        endforeach; ?>
    </div>
<?php else: // If user does not have projects... ?>
    <p class="abstract" style="margin-top: 50px;">
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
