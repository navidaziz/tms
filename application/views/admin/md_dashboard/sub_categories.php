<?php
// Controller Code: Fetch data from the database
$query = "SELECT sub_category, COUNT(*) as total 
          FROM `trainings` 
          GROUP BY sub_category";

// Running the query and fetching the result as an array of objects
$training_sub_categories = $this->db->query($query)->result();

?>
<div class="jumbotron" style="padding: 2px;">

    <div id="SubCategories" style="width:100%; height:400px;"></div>
</div>
    <script type="text/javascript">
        // Prepare data for the chart
        var categories = [];
        var data = [];

        <?php foreach ($training_sub_categories as $row): ?>
            categories.push('<?php echo $row->sub_category; ?>'); // Sub-category names
            data.push(<?php echo $row->total; ?>); // Total count for each sub-category
        <?php endforeach; ?>

        // Create the Highcharts Column Chart
        Highcharts.chart('SubCategories', {
            chart: {
                type: 'column' // Change this to 'pie' for a pie chart or 'bar' for a bar chart
            },
            title: {
                text: 'Training Sub-Categories Distribution'
            },
            xAxis: {
                categories: categories, // The x-axis categories will be sub-categories
                title: {
                    text: 'Training Sub-Category'
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
                data: data // The count of trainings for each sub-category
            }]
        });
    </script>
