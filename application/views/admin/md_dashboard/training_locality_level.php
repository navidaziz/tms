
<?php
// Controller Code: Fetch data from the database
$query = "SELECT `level` AS training_locality_level, COUNT(*) AS total 
          FROM `trainings` 
          GROUP BY `level`";

// Running the query and fetching the result as an array of objects
$training_locality_levels = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="traininglocalityLevel" style="width:100%; height:400px;"></div>
</div>
    <script type="text/javascript">
        // Prepare data for the chart
        var categories = [];
        var data = [];

        <?php foreach ($training_locality_levels as $row): ?>
            categories.push('<?php echo $row->training_locality_level; ?>');
            data.push(<?php echo $row->total; ?>);
        <?php endforeach; ?>

        // Create the Highcharts bar chart
        Highcharts.chart('traininglocalityLevel', {
            chart: {
                type: 'bar' // Bar chart
            },
            title: {
                text: 'Training Locality Level Distribution'
            },
            xAxis: {
                categories: categories // Locality levels
            },
            yAxis: {
                title: {
                    text: 'Number of Trainings'
                }
            },
            series: [{
                name: 'Total Trainings',
                data: data // Training counts
            }]
        });
    </script>
