<?php 
$query = "SELECT 
COUNT(*) AS total_mcqs, 
SUM(IF(pre_test_result = 1, 1, 0)) AS pre_test_correct,
SUM(IF(post_test_result = 1, 1, 0)) AS post_test_correct,
ROUND((SUM(IF(pre_test_result = 1, 1, 0)) / COUNT(*)) * 100, 2) AS pre_test_percentage,
ROUND((SUM(IF(post_test_result = 1, 1, 0)) / COUNT(*)) * 100, 2) AS post_test_percentage
FROM training_tests";
$pre_and_post_result = $this->db->query($query)->row();




?>

<!-- <table class="table table-bordered">
    <tr>
        <th>Total MCQs</th>
        <th>Pre-Test Correct</th>
        <th>Post-Test Correct</th>
        <th>Pre-Test Percentage</th>
        <th>Post-Test Percentage</th>
    </tr>
    <tr>
        <td><?php echo $pre_and_post_result->total_mcqs; ?></td>
        <td><?php echo $pre_and_post_result->pre_test_correct; ?></td>
        <td><?php echo $pre_and_post_result->post_test_correct; ?></td>
        <td><?php echo $pre_and_post_result->pre_test_percentage; ?>%</td>
        <td><?php echo $pre_and_post_result->post_test_percentage; ?>%</td>
    </tr>
</table> -->
<div class="jumbotron" style="padding: 2px;">
<div id="pre_post" style="width: 100%; height: 400px;"></div>
<table class="table table-striped">
<thead>
    <tr>
        <th>Pre-Test %</th>
        <th>Post-Test %</th>
        <th>Training Impact</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td><?php echo $pre_and_post_result->pre_test_percentage; ?>%</td>
        <td><?php echo $pre_and_post_result->post_test_percentage; ?>%</td>
        <td><?php echo $pre_and_post_result->post_test_percentage-$pre_and_post_result->pre_test_percentage; ?>%</td>
    </tr>
    </tbody>
</table>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
   Highcharts.chart('pre_post', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pre-Test vs Post-Test Performance'
            },
            xAxis: {
                categories: ['Test Results']
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
            
            yAxis: {
                min: 0,
                title: {
                    text: 'Percentage (%)'
                }
            },
            series: [{
                name: 'Pre-Test Correct',
                data: [<?php echo $pre_and_post_result->pre_test_percentage; ?>]
            }, {
                name: 'Post-Test Correct',
                data: [<?php echo $pre_and_post_result->post_test_percentage; ?>]
            }]
        });
   
</script>

