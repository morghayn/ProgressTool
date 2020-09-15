function timelineRedirect(categoryID, projectID, countryID)
{
    let token = jQuery("#token").attr("name");

    //window.location.href =
    window.open(
        `?option=com_progresstool` +
        `&view=projectstats` +
        `&task=timelineredirect.redirect` +
        `&` + [token] + `=1` +
        `&projectID=${projectID}` +
        `&categoryID=${categoryID}` +
        `&countryID=${countryID}`
    );
}

function redirectProjectBoard()
{
    window.location = '?option=com_progresstool&view=projectboard'
}

function opensesame(boxName)
{
    var x = document.getElementById(boxName);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function showGraphs()
{
    let columns = document.getElementById("columns")
    let graphs = document.getElementById("graphs")

    graphs.style.display = "block";
    columns.style.display = "none";
}

function showColumns()
{
    let columns = document.getElementById("columns")
    let graphs = document.getElementById("graphs")

    columns.style.display = "block";
    graphs.style.display = "none";
}

/**
 * Radar Chart
 */
function radarChart(pTotal)
{
    var data = {
        labels: ["People", "Technology", "Finance"],
        datasets: [
            {
                label: ' % progress',
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                pointBackgroundColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(255,99,132,1)",
                data: pTotal
}]};
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
    function barChart(pTotal)
    {
        let data = {
            labels: ["People", "Technology", "Finance"],
            datasets: [{
                label: '% progress',
                data: pTotal,
                backgroundColor: [
                    'rgba(247, 165, 138, 0.2)',
                    'rgba(149, 208, 171, 0.2)',
                    'rgba(150, 144, 198, 0.2)',
                ],
                borderColor: [
                    'rgba(247, 165, 138 ,1)',
                    'rgba(149, 208, 171, 1)',
                    'rgba(150, 144, 198, 1)',
                ],
                borderWidth: 1
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