<?php defined('_JEXEC') or die; ?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<div class="superChest">
    <?php echo $this->loadTemplate('preview'); ?>
    <?php echo $this->loadTemplate('editor'); ?>
</div>