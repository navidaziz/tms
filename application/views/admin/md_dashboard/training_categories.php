<?php
// Controller Code: Fetch data from the database
$query = "SELECT `category`, COUNT(*) as total 
          FROM `trainings` 
          GROUP BY `category`";

// Running the query and fetching the result as an array of objects
$training_categories = $this->db->query($query)->result();

?>


<div class="jumbotron" style="padding: 2px;">
<div id="container" style="width:100%; height:400px;"></div>
</div>

    <script type="text/javascript">
        // Prepare data for the chart
        var categories = [];
        var data = [];

        <?php foreach ($training_categories as $row): ?>
            categories.push('<?php echo $row->category; ?>'); // Training category names
            data.push(<?php echo $row->total; ?>); // Total count for each category
        <?php endforeach; ?>

        // Create the Highcharts Column Chart
        Highcharts.chart('container', {
            chart: {
                type: 'bar' // Change this to 'pie' for a pie chart
            },
            title: {
                text: 'Training Categories Distribution'
            },
            plotOptions: {
                bar: {
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
                categories: categories, // The x-axis categories will be training categories
                title: {
                    text: 'Training Category'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Trainings'
                }
            },
            series: [{
                name: 'Total Trainings',
                data: data // The count of trainings for each category
            }]
        });
    </script>
