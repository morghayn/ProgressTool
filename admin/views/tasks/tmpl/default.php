<?php defined('_JEXEC') or die; ?>
<?php echo $this->sidebar->render(); ?>

<input id="token"
       type="hidden"
       name="<?php echo JSession::getFormToken(); ?>"
       value="1"/>

<div id="main">
    <span class="openNavigation" onclick="openNav()">&#9776; navigation</span>
    <h1>Here we will display tasks</h1>
</div>
