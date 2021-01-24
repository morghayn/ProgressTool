<?php defined('_JEXEC') or die; ?>
<?php echo $this->loadTemplate('title'); ?>

<?php if ($this->projects): // If user has projects ?>
    <div id="projectViewer"><!--for project selection--></div>

    <div id="projects" class="projects">
        <?php
        $this->count = 0;

        foreach ($this->projects as $this->project):
            $this->count++;
            echo(
            $this->project->activated == 1
                ? $this->loadTemplate('active')
                : $this->loadTemplate('inactive')
            );
        endforeach; ?>
    </div>
<?php endif; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>