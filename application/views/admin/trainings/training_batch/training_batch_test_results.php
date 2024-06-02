<div class="col-md-12">
    <div class="table-responsive" style="overflow-y: auto;">

        <table class="table table-bordered table_small" id="db_table" style="font-size: 9px;">
            <thead>
                <tr>
                    <th colspan="8"></th>
                    <th colspan="4">Pre Test Result</th>
                    <th colspan="4">Post Test Result</th>

                </tr>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>CNIC</th>
                    <th>Designation</th>
                    <th>District</th>
                    <th>Qualification</th>
                    <th>Mobile No.</th>

                    <th>Total Question</th>
                    <th>Wrong Answers</th>
                    <th>Correct Answers</th>
                    <th>Percentage (%)</th>

                    <th>Total Question</th>
                    <th>Wrong Answers</th>
                    <th>Correct Answers</th>
                    <th>Percentage (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT users.*, training_nominations.nomination_type,  training_nominations.id
                                            FROM training_nominations 
                                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                                            AND users.role_id = 4
                                            AND training_nominations.training_id = " . $training->training_id;
                $nominations = $this->db->query($query)->result();
                $count = 1;
                foreach ($nominations as $nomination) : ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $nomination->name; ?></td>
                        <td><?php echo $nomination->father_name; ?></td>
                        <td><?php echo $nomination->cnic; ?></td>
                        <td><?php echo $nomination->designation; ?></td>
                        <td><?php echo $nomination->district; ?></td>
                        <td><?php echo $nomination->qualification; ?></td>
                        <td><?php echo $nomination->user_mobile_number; ?></td>

                        <?php
                        $trainee_id = $this->session->userdata('userId');
                        $query = "SELECT COUNT(*) as total, 
                                                        SUM(IF(pre_test_result=1,1,0)) as correct_ans,
                                                                    SUM(IF(pre_test_result=0,1,0)) as wrong_ans 
                                                                    FROM training_tests
                                                                        WHERE training_id = " . $training->training_id . "
                                                                        AND batch_id = " . $batch->batch_id . "
                                                                        AND trainee_id = " . $nomination->user_id . "";
                        $summary = $this->db->query($query)->row();
                        ?>

                        <td><?php echo $summary->total; ?></td>
                        <td><?php echo $summary->wrong_ans; ?></td>
                        <td><?php echo $summary->correct_ans; ?></td>
                        <td><?php
                            if ($summary->total) {
                                echo @round(($summary->correct_ans * 100) / $summary->total, 2) . " %";
                            }
                            ?></td>

                        <?php
                        $trainee_id = $this->session->userdata('userId');
                        $query = "SELECT COUNT(*) as total, 
                                                                SUM(IF(post_test_result=1,1,0)) as correct_ans,
                                                                    SUM(IF(post_test_result=0,1,0)) as wrong_ans 
                                                                    FROM training_tests
                                                                WHERE training_id = " . $training->training_id . "
                                                                        AND batch_id = " . $batch->batch_id . "
                                                                        AND trainee_id = " . $nomination->user_id . "";
                        $summary = $this->db->query($query)->row(); ?>
                        <td><?php echo $summary->total; ?></td>
                        <td><?php echo $summary->wrong_ans; ?></td>
                        <td><?php echo $summary->correct_ans; ?></td>
                        <td><?php
                            if ($summary->total) {
                                echo @round(($summary->correct_ans * 100) / $summary->total, 2) . " %";
                            }
                            ?></td>



                    </tr>


                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</div>

<hr class="margin-bottom-0">

<script>
    <?php $table_title = "For Training " . $training->title . "(Code: " . $training->code . ") " . " Batch: " . $title . " " . date('d-m-Y h:m:s'); ?>
    title = '<?php echo 'T-Code:(' . $training->code . ") - " . $title; ?> Trainees Test Results';
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