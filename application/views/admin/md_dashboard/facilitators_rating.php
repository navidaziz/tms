<?php
$ratings = array(
    1 => 'Poor',
    2 => 'Fair',
    3 => 'Good',
    4 => 'Very Good',
    5 => 'Excellent'
);

// Execute the query to fetch aggregated ratings
$query = "SELECT COUNT(fe.facilitator_id) AS feedbacks, 
    AVG(fe.subject_knowledge) AS subject_knowledge, 
    AVG(fe.lecture_contents) AS lecture_contents, 
    AVG(fe.teaching_methodology) AS teaching_methodology, 
    AVG(fe.time_utilization) AS time_utilization, 
    AVG(fe.participants_engagement) AS participants_engagement,
    (AVG(fe.subject_knowledge) + AVG(fe.lecture_contents) + AVG(fe.teaching_methodology) + AVG(fe.time_utilization) + AVG(fe.participants_engagement)) / 5 AS avg_rating
FROM training_nominations
INNER JOIN users ON(users.user_id = training_nominations.user_id)
INNER JOIN facilitator_evaluations fe ON(fe.facilitator_id = users.user_id)
WHERE training_nominations.nomination_type = 'Facilitator'";
$facilitators = $this->db->query($query)->result();
?>





<div class="jumbotron" style="padding: 2px;">
<div id="ratingsChart" style="width:100%; height:400px;"></div>
<table class="table table_small table-striped " id="facilities_table">
    <thead>
        <tr>
            <th>Subject Knowledge</th>
            <th>Lecture Contents</th>
            <th>Teaching Methodology</th>
            <th>Time Utilization</th>
            <th>Participants Engagement</th>
            <th>AVG Rating</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Extract the first (and only) result from the query
        $facilitator = $facilitators[0];

        // Round each of the ratings and store in arrays (for use in the chart)
        $subjectKnowledge = round($facilitator->subject_knowledge, 2);
        $lectureContents = round($facilitator->lecture_contents, 2);
        $teachingMethodology = round($facilitator->teaching_methodology, 2);
        $timeUtilization = round($facilitator->time_utilization, 2);
        $participantsEngagement = round($facilitator->participants_engagement, 2);
        $avgRating = round($facilitator->avg_rating, 2);

        // Add each of the ratings to respective arrays for chart
        $subjectKnowledgeArray = [$subjectKnowledge];
        $lectureContentsArray = [$lectureContents];
        $teachingMethodologyArray = [$teachingMethodology];
        $timeUtilizationArray = [$timeUtilization];
        $participantsEngagementArray = [$participantsEngagement];
        $avgRatingsArray = [$avgRating];
        ?>
        <tr>
            <td><?php echo $subjectKnowledge; ?>
                <small style="display:block"><?php echo $ratings[round($subjectKnowledge)] ?? 'N/A'; ?></small>
            </td>
            <td><?php echo $lectureContents; ?>
                <small style="display:block"><?php echo $ratings[round($lectureContents)] ?? 'N/A'; ?></small>
            </td>
            <td><?php echo $teachingMethodology; ?>
                <small style="display:block"><?php echo $ratings[round($teachingMethodology)] ?? 'N/A'; ?></small>
            </td>
            <td><?php echo $timeUtilization; ?>
                <small style="display:block"><?php echo $ratings[round($timeUtilization)] ?? 'N/A'; ?></small>
            </td>
            <td><?php echo $participantsEngagement; ?>
                <small style="display:block"><?php echo $ratings[round($participantsEngagement)] ?? 'N/A'; ?></small>
            </td>
            <td><?php echo $avgRating; ?>
                <small style="display:block"><?php echo $ratings[round($avgRating)] ?? 'N/A'; ?></small>
            </td>
        </tr>
    </tbody>
</table>
</div>

<script type="text/javascript">
    // Data from PHP
    var ratings = <?php echo json_encode($ratings); ?>;
    var subjectKnowledge = <?php echo $subjectKnowledge; ?>;
    var lectureContents = <?php echo $lectureContents; ?>;
    var teachingMethodology = <?php echo $teachingMethodology; ?>;
    var timeUtilization = <?php echo $timeUtilization; ?>;
    var participantsEngagement = <?php echo $participantsEngagement; ?>;
    var avgRating = <?php echo $avgRating; ?>;

    Highcharts.chart('ratingsChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Trainees Ratings and Feedback on Facilitators Training'
        },
        xAxis: {
            categories: ['Subject Knowledge', 'Lecture Contents', 'Teaching Methodology', 'Time Utilization', 'Participants Engagement', 'Average Rating'],
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
            name: 'Training Ratings',
            data: [subjectKnowledge, lectureContents, teachingMethodology, timeUtilization, participantsEngagement, avgRating],
            color: '#3498db'
        }]
    });
</script>
