<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<div class="superChest">
    <?php echo $this->loadTemplate('preview'); ?>

    <div class="editor">
        <?php echo $this->loadTemplate('edit_icon'); ?>
        <?php echo $this->loadTemplate('edit_question'); ?>
        <?php echo $this->loadTemplate('edit_choice'); ?>
    </div>
</div>