<?php defined('_JEXEC') or die; ?>

<?php
// Retrieving any style overrides
$styleOverride = '';
if (array_key_exists('overrides', $displayData)):
    foreach ($displayData['overrides'] as $override):
        $styleOverride .= ($override . ';');
    endforeach;
endif;
?>


<!-- Heading -->
<div id="heading" class="heading stickyHeading" style="top: 31px; <?php echo $styleOverride; ?>">
    <span class="openSidebar" onclick="openNav()">&#9776;</span>

    <?php if (array_key_exists('additions', $displayData)): ?>
        <?php foreach ($displayData['additions'] as $addition): ?>
            <?php echo $addition; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <h1><?php echo $displayData['page']; ?></h1>
</div>