<?php defined('_JEXEC') or die; ?>

    <input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php echo $this->loadTemplate('title'); ?>

<div class="superChest">

<?php

foreach ($this->categories as $this->category):
    echo $this->loadTemplate('category');
endforeach;

?>

</div>
