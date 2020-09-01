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

<p class="introductionParagraph">
    The graph below shows the % progression under each heading: <b class="people">People</b>, <b class="technology">Technology</b> and
    <b class="finance">Finance</b>.
    <br>
    All heading should be progressed at an even rate, if one is developing faster than the others think about focusing on the less developed heading
    tasks.
</p>

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