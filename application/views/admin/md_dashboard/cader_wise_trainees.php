<?php
// Controller Code: Fetch data from the database
$query = "SELECT cadre as cader, COUNT(*) as total 
          FROM `users` 
          WHERE role_id = 4 
          GROUP BY cader 
          ORDER BY total DESC";

// Running the query and fetching the result as an array of objects
$cader_data = $this->db->query($query)->result();

?>
<div class="jumbotron" style="padding: 2px;">
    <div id="caderWiseTrainees" style="width:100%; height:400px;"></div>
</div>
    <script type="text/javascript">
        // Prepare data for the pie chart
        var data = [];

        <?php foreach ($cader_data as $row): ?>
            data.push({
                name: '<?php echo $row->cader; ?>',
                y: <?php echo $row->total; ?>
            });
        <?php endforeach; ?>

        // Create the Highcharts Pie Chart
        Highcharts.chart('caderWiseTrainees', {
            chart: {
                type: 'pie' // Pie chart
            },
            title: {
                text: 'Cader Wise Trainees'
            },
            series: [{
                name: 'Trainees',
                data: data
            }]
        });
    </script>
