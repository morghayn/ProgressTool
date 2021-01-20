<?php defined('_JEXEC') or die; ?>

<!-- Main -->
<div id="main">
    <?php echo $this->heading; ?>
    <?php echo $this->sidebar; ?>

    <div style="width: 60%; margin: 0 auto;">
        <?php $this->questionCounter = 0; ?>
        <?php foreach ($this->questions as $this->question): ?>
            <?php $this->questionCounter++; ?>
            <?php echo $this->loadTemplate('question'); ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- CSRF Token -->
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>