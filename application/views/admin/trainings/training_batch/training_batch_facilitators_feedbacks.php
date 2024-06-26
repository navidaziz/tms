<div class="col-md-12">
    <div class="table-responsive" >
    <style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 4px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 10px !important;
        color: black;
        margin: 0px !important;
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
$query="SELECT 
AVG(trainings_hall_environment) AS trainings_hall_environment, 
AVG(food) AS food, 
AVG(hostel) AS hostel,
AVG(extra_physical_activities) AS extra_physical_activities,
(AVG(trainings_hall_environment) + AVG(food) + AVG(hostel) + AVG(extra_physical_activities)) / 4 AS avg_rating
FROM 
facilities_evaluations
WHERE batch_id = '" . $batch->batch_id . "'
AND training_id = '" . $training->training_id."'";
$faciliteis_rating = $this->db->query($query)->row();

?>
<h4>Feedback about Facilities:</h4>
<div class="rating-legend" style="text-align:right">
    Ratings: <span class="poor">1️⃣ (Poor)</span>
    <span class="fair">2️⃣ (Fair)</span>
    <span class="good">3️⃣ (Good)</span>
    <span class="very-good">4️⃣ (Very Good)</span>
    <span class="excellent">5️⃣ (Excellent)</span>
</div>
        <table class="table table_small" id="db_table2">
            <thead>
            <tr>
                <th>Hall Environment</th>
                <th>Food</th>
                <th>Hostel</th>
                <th>Extra Physical Activities</th>
                <th>AVG Rating</th>
            </tr>
        </thead>
        <tbody>
            <tr>
        <td>
        <?php if($faciliteis_rating->trainings_hall_environment>0){ ?>    
        <?php echo round($faciliteis_rating->trainings_hall_environment,2); ?>
                    <small style="display:block"><?php echo $ratings[round($faciliteis_rating->trainings_hall_environment)]; ?></small>
      <?php } ?>
                </td>
                <td>
                   <?php if($faciliteis_rating->food>0){ ?>   
                        <?php echo round($faciliteis_rating->food,2); ?>
                        <small style="display:block"><?php echo $ratings[round($faciliteis_rating->food)]; ?></small>
                   <?php } ?>
                </td>
                    <td>
                    <?php if($faciliteis_rating->hostel>0){ ?> 
                        <?php echo round($faciliteis_rating->hostel,2); ?>
                        <small style="display:block"><?php echo $ratings[round($faciliteis_rating->hostel)]; ?></small>
                   <?php } ?>
                    </td>
                     <td>
                    <?php if($faciliteis_rating->extra_physical_activities>0){ ?>     
                        <?php echo round($faciliteis_rating->extra_physical_activities,2); ?>
                        <small style="display:block"><?php echo $ratings[round($faciliteis_rating->extra_physical_activities)]; ?></small>
                   <?php } ?>
                    </td>
                    <td>
                    <?php if($faciliteis_rating->avg_rating>0){ ?> 
                        <?php echo round($faciliteis_rating->avg_rating,2); ?>
                        <small style="display:block"><?php echo $ratings[round($faciliteis_rating->avg_rating)]; ?></small>
                    <?php } ?>
                    </td>
                    </tr>
        </tbody>
</table>


<h4>Feedback about facilitators:</h4>
<div class="rating-legend" style="text-align:right">
    Ratings: <span class="poor">1️⃣ (Poor)</span>
    <span class="fair">2️⃣ (Fair)</span>
    <span class="good">3️⃣ (Good)</span>
    <span class="very-good">4️⃣ (Very Good)</span>
    <span class="excellent">5️⃣ (Excellent)</span>
</div>
        <table class="table table_small" id="db_table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>CNIC</th>
                    <th>Designation</th>
                    <th>District</th>
                    <th>Qualification</th>
                    <th>Mobile No.</th>
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
            
                $query = "SELECT users.*, training_nominations.nomination_type,  training_nominations.id,
                COUNT(fe.facilitator_id) AS feedbacks, 
                AVG(fe.subject_knowledge) AS `subject_knowledge`, 
                AVG(fe.lecture_contents) AS `lecture_contents`, 
                AVG(fe.teaching_methodology) AS `teaching_methodology`, 
                AVG(fe.time_utilization) AS `time_utilization`, 
                AVG(fe.participants_engagement) AS `participants_engagement`,
                (AVG(fe.subject_knowledge) + AVG(fe.lecture_contents) + AVG(fe.teaching_methodology) + AVG(fe.time_utilization) + AVG(fe.participants_engagement)) / 5 AS `avg_rating`

                                            FROM training_nominations 
                                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                            INNER JOIN facilitator_evaluations fe ON(fe.facilitator_id = users.user_id)
                                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                                            AND training_nominations.nomination_type = 'Facilitator'
                                            AND training_nominations.training_id = " . $training->training_id.'
                                            GROUP BY fe.facilitator_id';
                $facilitators = $this->db->query($query)->result();
                $count = 1;
                foreach ($facilitators as $facilitator) : ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $facilitator->name; ?></td>
                        <td><?php echo $facilitator->father_name; ?></td>
                        <td><?php echo $facilitator->cnic; ?></td>
                        <td><?php echo $facilitator->designation; ?></td>
                        <td><?php echo $facilitator->district; ?></td>
                        <td><?php echo $facilitator->qualification; ?></td>
                        <td><?php echo $facilitator->user_mobile_number; ?></td>
                        <td><?php echo round($facilitator->subject_knowledge,2); ?>
                    <small style="display:block"><?php echo $ratings[round($facilitator->subject_knowledge)]; ?></small>
                    </td>
                        <td><?php echo round($facilitator->lecture_contents,2); ?>
                        <small style="display:block"><?php echo $ratings[round($facilitator->lecture_contents)]; ?></small>
                   
                    </td>

                    <td><?php echo round($facilitator->teaching_methodology,2); ?>
                        <small style="display:block"><?php echo $ratings[round($facilitator->teaching_methodology)]; ?></small>
                    </td>

                        <td><?php echo round($facilitator->time_utilization,2); ?>
                        <small style="display:block"><?php echo $ratings[round($facilitator->time_utilization)]; ?></small>
                    </td>
                        <td><?php echo round($facilitator->participants_engagement,2); ?>
                        <small style="display:block"><?php echo $ratings[round($facilitator->participants_engagement)]; ?></small>
                    </td>
                        <td><?php echo round($facilitator->avg_rating,2); ?>
                        <small style="display:block"><?php echo $ratings[round($facilitator->avg_rating)]; ?></small>
                    </td>
                    </tr>


                <?php endforeach; ?>
            </tbody>
        </table>
        

    </div>
</div>
<hr class="margin-bottom-0">

<script>
    <?php $table_title = "For Training " . $training->title . "(Code: " . $training->code . ") " . " Batch: " . $title . " " . date('d-m-Y h:m:s'); ?>
    title = '<?php echo 'T-Code:(' . $training->code . ") - " . $title; ?> Facilitators Feedback List';
    $(document).ready(function() {
        $('#db_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": true,
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>'

                }
            ]
        });
    });
</script>
<script>
    <?php $table_title = "For Training " . $training->title . "(Code: " . $training->code . ") " . " Batch: " . $title . " " . date('d-m-Y h:m:s'); ?>
    title = '<?php echo 'T-Code:(' . $training->code . ") - " . $title; ?> Facilities Feedback List';
    $(document).ready(function() {
        $('#db_table2').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": true,
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>'

                }
            ]
        });
    });
</script>