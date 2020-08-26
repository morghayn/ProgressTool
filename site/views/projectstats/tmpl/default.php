<?php

defined('_JEXEC') or die;

$pTotal = array();
foreach ($this->categories as $category)
{
    $x = $category->total / 100;
    $y = $this->totals[$category->id] / $x;
    array_push($pTotal, $y);
    var_dump($pTotal);
    /**
     * var_dump($y);
     */
}

?>

<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php echo $this->loadTemplate('title'); ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<div class="testing">
    <canvas id="myChart" width="50%" height="50%"></canvas>
</div>

<div class="testing">
    <canvas id="myBars" width="50%" height="50%"></canvas>
</div>

<script>
    /**
     * Radar Chart
     */
    function radarChart()
    {
        var data = {
            labels: ["People", "Technology", "Finance"],
            datasets: [
                {
                    label: "My First dataset",
                    backgroundColor: "rgba(255,99,132,0.2)",
                    borderColor: "rgba(255,99,132,1)",
                    pointBackgroundColor: "rgba(255,99,132,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(255,99,132,1)",
                    data: [<?php echo implode(',', $pTotal); ?>]
                }
            ]
        };
        var ctx = document.getElementById("myChart");
        var options = {
            scale: {
                angleLines: {
                    display: false
                },
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 100
                }
            }
        };
        var myRadarChart = new Chart(ctx, {
            type: 'radar',
            data: data,
            options: options
        });
    }

    /**
     * Bar Chart
     */
    function barChart()
    {
        let data = {
            labels: ["People", "Technology", "Finance"],
            datasets: [{
                label: '% progress in each category',
                data: [<?php echo implode(',', $pTotal); ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
                //barPercentage: 0.5,
                //barThickness: 6,
                //maxBarThickness: 8,
                //minBarLength: 2,
            }]
        };
        let options = {
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        maxRotation: 90,
                        minRotation: 80
                    }
                }],
                yAxes: [{
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 100,
                        beginAtZero: true
                    }
                }]
            }
        };
        let ctx = document.getElementById("myBars");
        let myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    }

    radarChart();
    barChart();
</script>

<div class="superChest">

    <?php

    foreach ($this->categories as $this->category):
        echo $this->loadTemplate('category');
    endforeach;

    ?>

</div>
