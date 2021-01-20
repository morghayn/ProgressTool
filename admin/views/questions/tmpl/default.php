<?php defined('_JEXEC') or die; ?>
<?php echo $this->sidebar->render(); ?>

<input id="token"
       type="hidden"
       name="<?php echo JSession::getFormToken(); ?>"
       value="1"/>

<div id="main">
    <span class="openNavigation" onclick="openNav()">&#9776; navigation</span>

    <div style="width: 60%; margin: 0 auto;">
        <?php $this->questionCounter = 0; ?>
        <?php foreach ($this->questions as $this->question): ?>
            <?php $this->questionCounter++; ?>
            <?php echo $this->loadTemplate('question'); ?>
        <?php endforeach; ?>
    </div>
</div>
