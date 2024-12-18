<?php
// Controller Code: Fetch data from the database
$query = "SELECT type AS training_type, COUNT(*) AS total 
          FROM `trainings` 
          GROUP BY training_type";

// Running the query and fetching the result as an array of objects
$training_types = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">

    <div id="TrainingType2" style="width:100%; height:400px;"></div>
</div>
    <script type="text/javascript">
        // Prepare data for the chart
        var categories = [];
        var data = [];

        <?php foreach ($training_types as $row): ?>
            categories.push('<?php echo $row->training_type; ?>'); // training type names
            data.push(<?php echo $row->total; ?>); // total count of each type
        <?php endforeach; ?>

        // Create the Highcharts chart
        Highcharts.chart('TrainingType2', {
            chart: {
                type: 'column' // You can change this to 'bar', 'pie', etc.
            },
            title: {
                text: 'Training Types Distribution'
            },
            xAxis: {
                categories: categories, // The x-axis categories will be training types
                title: {
                    text: 'Training Type'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Trainings'
                }
            },
            series: [{
                name: 'Training Count',
                data: data // The count of trainings for each type
            }]
        });
    </script>
