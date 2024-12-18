<?php
// Controller Code: Fetch data from the database
$query = "SELECT `training_for`, COUNT(*) as total 
          FROM `trainings` 
          GROUP BY `training_for`";
$training_for_data = $this->db->query($query)->result();
?>

    

<div class="jumbotron" style="padding: 2px;">
    <div id="TrainingFor" style="width:100%; height:400px;"></div>
</div>
    <script type="text/javascript">
        // Prepare data for the chart
        var categories = [];
        var data = [];

        <?php foreach ($training_for_data as $row): ?>
            categories.push('<?php echo $row->training_for; ?>'); // Training "For" values
            data.push(<?php echo $row->total; ?>); // Total count for each "Training For" value
        <?php endforeach; ?>

        // Create the Highcharts Column Chart
        Highcharts.chart('TrainingFor', {
            chart: {
                type: 'column' // You can change this to 'pie' for a pie chart or 'bar' for a bar chart
            },
            title: {
                text: 'Training / Workshop "For"'
            },
            xAxis: {
                categories: categories, // The x-axis categories will be training "for" values
                title: {
                    text: 'Training For'
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
                data: data // The count of trainings for each "training_for"
            }]
        });
    </script>
