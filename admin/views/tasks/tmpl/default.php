<?php defined('_JEXEC') or die; ?>

<input id="token"
       type="hidden"
       name="<?php echo JSession::getFormToken(); ?>"
       value="1"/>

<div id="main">
    <?php echo $this->loadTemplate('sidebar'); ?>

    <span class="openNavigation" onclick="openNav()">&#9776; navigation</span>

    <h1>Here we will display tasks</h1>
</div>
