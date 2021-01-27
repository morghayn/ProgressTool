<?php defined('_JEXEC') or die; ?>

<!-- Heading -->
<div id="heading" class="heading stickyHeading">
    <span class="openSidebar" onclick="openNav()">&#9776;</span>

    <?php if (array_key_exists('additions', $displayData)): ?>
        <?php foreach ($displayData['additions'] as $addition): ?>
            <?php echo $addition; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <h1><?php echo $displayData['page']; ?></h1>
</div>