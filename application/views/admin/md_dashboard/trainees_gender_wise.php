<?php
// SQL query to get gender distribution for Trainees (role_id = 4)
$query = "SELECT roles.role_title, users.gender, COUNT(*) as total
FROM `users`
INNER JOIN roles ON (roles.role_id = users.role_id)
WHERE roles.role_id=4
GROUP BY roles.role_id, users.gender";

// Execute the query and get the result
$results = $this->db->query($query)->result();  
?>

<div class="jumbotron" style="padding: 2px;">

<!-- Pie Chart Section -->
<div id="genderPieChart" style="width:100%; height:400px;"></div>
<!-- Table displaying gender distribution -->
<table class="table table-striped" id="genderTable">
    <thead>
        <tr>
        <?php foreach ($results as $row): ?>
            <td><?php echo htmlspecialchars($row->gender); ?></td>
        <?php endforeach; ?>
        <th>Total Trainees</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <?php 
        $total_facilitators=0;
        foreach ($results as $row): ?>
            <td><?php 
            $total_facilitators+=$row->total;
            echo $row->total; ?></td>
        <?php endforeach; ?>
        <td><?php echo $total_facilitators; ?></td>
        </tr>
    </tbody>
</table>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    // Data from PHP query results
    var pieData = <?php echo json_encode($results); ?>;

    var chartData = pieData.map(function(item) {
        // Check if gender is "Female" and assign the color pink
        var color = item.gender === 'Female' ? '#FF69B4' : '#2CAFFD';
        
        return {
            name: item.gender,  // Gender (Male or Female)
            y: parseInt(item.total),  // Total count
            color: color  // Set the color for Female
        };
    });

    // Create the pie chart
    Highcharts.chart('genderPieChart', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Gender Distribution of Trainees'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Gender',
            colorByPoint: true,
            data: chartData
        }]
    });
</script>

