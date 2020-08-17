<?php defined('_JEXEC') or die; ?>

<style>
    /** Overriding Joomla's CSS */
    body, .container-main, #system-debug {
        padding: 0;
    }

    .navbar-fixed-top, .navbar-fixed-bottom {
        position: fixed;
    }

    .navbar, .collapse {
        margin: 0 auto;
        width: 100%;
    }
</style>

<div class="sidebar">
    <?php for ($i = 0; $i < 5; $i++) { ?>
        <div class="sidebarSection">
            <p>Hello World</p>
        </div>
    <?php } ?>
</div>

<div class="questions">

</div>