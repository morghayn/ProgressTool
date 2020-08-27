<?php

defined('_JEXEC') or die;

$pTotal = array();
foreach ($this->categories as $category)
{
    $x = $category->total / 100;
    $y = array_key_exists($category->id, $this->totals) ? intval($this->totals[$category->id] / $x) : 0;
    array_push($pTotal, $y);
}

?>

<div class="testing">
    <canvas id="myChart" width="50%" height="50%"></canvas>
</div>

<div class="testing">
    <canvas id="myBars" width="50%" height="50%"></canvas>
</div>

<script>
    let pTotal = [<?php echo implode(',', $pTotal); ?>];
    console.log(pTotal);
    radarChart(pTotal);
    barChart(pTotal);
</script>