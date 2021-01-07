<?php defined('_JEXEC') or die; ?>

<!-- Sidebar -->
<?php $fragments = array('Dashboard', 'Projects', 'Pools'); ?>
<div id="sideNavigation" class="sideNavigation">
    <a href="javascript:void(0)" class="closeButton" onclick="closeNav()">&times;</a>
    <?php foreach ($fragments as $fragment): ?>
        <a href="?option=com_progresstool&view=<?php echo $fragment; ?>"><?php echo $fragment; ?></a>
    <?php endforeach; ?>
</div>