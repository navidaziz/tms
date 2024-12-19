<style>
#facilities_table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}

/* Table Header */
#facilities_table thead {
    background-color: #f5f5f5;
    font-weight: bold;
}

#facilities_table th {
    padding: 12px;
    text-align: center;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
}

/* Table Cells */
#facilities_table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}

/* Styling for the rating legend */


.rating-legend span {
    margin: 0 10px;
    font-size: 14px;
}

/* Color coding for ratings */
.poor { color: #e74c3c; }
.fair { color: #f39c12; }
.good { color: #2ecc71; }
.very-good { color: #3498db; }
.excellent { color: #9b59b6; }

/* Rating text under each score */
.rating-text {
    display: block;
    margin-top: 5px;
    font-size: 12px;
    color: #555;
}

/* Small Table Styling */
.table-striped {
    background-color: #fafafa;
}

.table-striped tr:nth-child(even) {
    background-color: #f9f9f9;
}
</style>

<?php 
$ratings = array(
    1 => 'Poor',
    2 => 'Fair',
    3 => 'Good',
    4 => 'Very Good',
    5 => 'Excellent'
);

$query = "SELECT 
AVG(trainings_hall_environment) AS trainings_hall_environment, 
AVG(food) AS food, 
AVG(hostel) AS hostel,
AVG(extra_physical_activities) AS extra_physical_activities,
(AVG(trainings_hall_environment) + AVG(food) + AVG(hostel) + AVG(extra_physical_activities)) / 4 AS avg_rating
FROM 
facilities_evaluations";
$faciliteis_rating = $this->db->query($query)->row();
?>



<div class="jumbotron" style="padding: 2px;">
<div id="facilitiesChart" style="width:100%; height:400px;"></div>
<table class="table table_small table-striped " id="facilities_table">
    <thead>
        <tr>
            <th>Hall Environment</th>
            <th>Food</th>
            <th>Hostel</th>
            <th>Extra Physical Activities</th>
            <th>Average Rating</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php if ($faciliteis_rating->trainings_hall_environment > 0) { ?>    
                    <?php echo round($faciliteis_rating->trainings_hall_environment, 2); ?>
                    <small class="rating-text"><?php echo $ratings[round($faciliteis_rating->trainings_hall_environment)]; ?></small>
                <?php } ?>
            </td>
            <td>
                <?php if ($faciliteis_rating->food > 0) { ?>   
                    <?php echo round($faciliteis_rating->food, 2); ?>
                    <small class="rating-text"><?php echo $ratings[round($faciliteis_rating->food)]; ?></small>
                <?php } ?>
            </td>
            <td>
                <?php if ($faciliteis_rating->hostel > 0) { ?> 
                    <?php echo round($faciliteis_rating->hostel, 2); ?>
                    <small class="rating-text"><?php echo $ratings[round($faciliteis_rating->hostel)]; ?></small>
                <?php } ?>
            </td>
            <td>
                <?php if ($faciliteis_rating->extra_physical_activities > 0) { ?>     
                    <?php echo round($faciliteis_rating->extra_physical_activities, 2); ?>
                    <small class="rating-text"><?php echo $ratings[round($faciliteis_rating->extra_physical_activities)]; ?></small>
                <?php } ?>
            </td>
            <td>
                <?php if ($faciliteis_rating->avg_rating > 0) { ?> 
                    <?php echo round($faciliteis_rating->avg_rating, 2); ?>
                    <small class="rating-text"><?php echo $ratings[round($faciliteis_rating->avg_rating)]; ?></small>
                <?php } ?>
            </td>
        </tr>
    </tbody>
</table>


                </div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    // Data from PHP
    var ratings = <?php echo json_encode($ratings); ?>;
    var hallEnvironment = <?php echo round($faciliteis_rating->trainings_hall_environment, 2); ?>;
    var food = <?php echo round($faciliteis_rating->food, 2); ?>;
    var hostel = <?php echo round($faciliteis_rating->hostel, 2); ?>;
    var extraPhysicalActivities = <?php echo round($faciliteis_rating->extra_physical_activities, 2); ?>;
    var avgRating = <?php echo round($faciliteis_rating->avg_rating, 2); ?>;

    Highcharts.chart('facilitiesChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rating of Training Facilities Provided to Trainees'
        },
        xAxis: {
            categories: ['Hall Environment', 'Food', 'Hostel', 'Extra Physical Activities', 'Average Rating'],
            title: {
                text: 'Rating Categories'
            }
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
            min: 1,
            max: 5,
            title: {
                text: 'Ratings'
            },
            tickInterval: 1
        },
        tooltip: {
            pointFormat: '<b>{point.y}</b> rating'
        },
        series: [{
            name: 'Facilities Rating',
            data: [hallEnvironment, food, hostel, extraPhysicalActivities, avgRating],
            color: '#3498db'
        }]
    });
</script>
