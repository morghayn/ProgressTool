function timelineRedirect(categoryID, projectID, countryID)
{
    let token = jQuery("#token").attr("name");

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

function toggleDisplay(elementID)
{
    let x = document.getElementById(elementID)

    if (x.style.display === "none")
    {
        x.style.display = "block"
    }
    else
    {
        x.style.display = "none"
    }
}

function showGraphs()
{
    let taskColumnsAbstract = document.getElementById("taskColumnsAbstract")
    let graphsAbstract = document.getElementById("graphsAbstract")
    let taskColumns = document.getElementById("taskColumns")
    let graphs = document.getElementById("graphs")

    taskColumnsAbstract.style.display = "none"
    graphsAbstract.style.display = "block"
    taskColumns.style.display = "none"
    graphs.style.display = "block"
}

function showColumns()
{
    let taskColumnsAbstract = document.getElementById("taskColumnsAbstract")
    let graphsAbstract = document.getElementById("graphsAbstract")
    let taskColumns = document.getElementById("taskColumns")
    let graphs = document.getElementById("graphs")

    taskColumnsAbstract.style.display = "block"
    graphsAbstract.style.display = "none"
    taskColumns.style.display = "flex"
    graphs.style.display = "none"
}

/**
 * Radar Chart
 */
function radarChart(labels, progress)
{
    let data = {
        labels: labels,
        datasets: [
            {
                label: ' % progress',
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                pointBackgroundColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(255,99,132,1)",
                data: progress
            }]
    }
    let options = {
        responsive: true,
        maintainAspectRatio: true,
        scale: {
            angleLines: {
                display: false
            },
            ticks: {
                suggestedMin: 0,
                suggestedMax: 100
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: -20
                }
            }
        }
    }
    let ctx = document.getElementById("radarGraph")
    let myRadarChart = new Chart(ctx, {
        type: 'radar',
        data: data,
        options: options
    })
}

/**
 * Bar Chart
 */
function barChart(labels, progress)
{
    let data = {
        labels: labels,
        datasets: [{
            label: '% progress',
            data: progress,
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
    }
    let options = {
        responsive: true,
        maintainAspectRatio: true,
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
    }
    let ctx = document.getElementById("barGraph")
    let myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    })
}