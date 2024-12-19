<?php
// SQL query to get the district-wise count of users for role_id = 4
$query = "SELECT district, COUNT(*) as total 
          FROM `users` 
          WHERE role_id=4 
          GROUP BY district 
          ORDER BY total DESC";

// Execute the query and get the result
$results = $this->db->query($query)->result();
?>

<div class="jumbotron" style="padding: 2px;">
<div id="districtColumnChart" style="width:100%; height:400px;"></div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    // Data from PHP query results
    var chartData = <?php echo json_encode($results); ?>;

    // Prepare categories (district names) and data (user count) for Highcharts
    var categories = chartData.map(function(item) {
        return item.district;  // District names
    });

    var data = chartData.map(function(item) {
        return parseInt(item.total);  // Total users for each district
    });

    // Create the column chart
    Highcharts.chart('districtColumnChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'District-wise Total Count by Trainees'
        },
        plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true, // Enable data labels
                        style: {
                        fontWeight: 'bold',
                        color: 'black' // Color of the text
                    },
                    verticalAlign: 'bottom', // Align the label to the bottom of the bar
                    y: -5 // Adjust the position to move the label above the bar
                    }
                }
            },
            
        xAxis: {
            categories: categories,  // Districts as x-axis categories
            title: {
                text: 'District'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of Trainees'
            }
        },
        tooltip: {
            pointFormat: '<b>{point.y}</b> trainees'
        },
        series: [{
            name: 'Total Trainees',
            data: data,  // Number of trainees for each district
            color: '#3498db'  // Column color
        }]
    });
</script>
