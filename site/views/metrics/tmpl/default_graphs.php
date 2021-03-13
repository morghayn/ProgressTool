<?php defined('_JEXEC') or die; ?>

<div class="graphs" id="graphs">
    <canvas id="radarGraph" width="100" height="100"></canvas>
    <canvas id="barGraph" width="100" height="100"></canvas>
</div>

<script>
    let labels = [<?php echo '"' . implode('" , "', array_column($this->categories, 'category')) . '"'; ?>]
    let progress = [<?php echo '"' . implode('" , "', array_column($this->categories, 'progress')) . '"'; ?>]
    radarChart(labels, progress)
    barChart(labels, progress)
</script>