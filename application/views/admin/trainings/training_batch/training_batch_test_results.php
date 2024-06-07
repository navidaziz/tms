<div class="col-md-12">
    <div class="table-responsive" style="overflow-y: auto;">

        <table class="table table-bordered table_small" id="db_table" style="font-size: 9px;">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>


            <tbody>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                    <th colspan="4">Pre Test</th>
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>


                    <th colspan="4">Post Test</th>
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                    <th></th>



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
                    <th>Training Certificates</th>
                </tr>
                <?php
                $query = "SELECT users.*, training_nominations.nomination_type,  training_nominations.id
                                            FROM training_nominations 
                                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                                            AND users.role_id = 4
                                            AND training_nominations.training_id = " . $training->training_id;
                $nominations = $this->db->query($query)->result();
                $count = 1;
                foreach ($nominations as $nomination) { ?>
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

                        <td><?php echo $pre_test = $summary->total; ?></td>
                        <td><?php echo $summary->wrong_ans; ?></td>
                        <td><?php echo $summary->correct_ans; ?></td>
                        <td><?php
                            if ($summary->total) {
                                echo @round(($summary->correct_ans * 100) / $summary->total, 2) . " %";
                            }
                            ?></td>

                        <?php
                        // $trainee_id = $this->session->userdata('userId');
                        $query = "SELECT COUNT(*) as total, 
                                                                SUM(IF(post_test_result=1,1,0)) as correct_ans,
                                                                    SUM(IF(post_test_result=0,1,0)) as wrong_ans 
                                                                    FROM training_tests
                                                                WHERE training_id = " . $training->training_id . "
                                                                        AND batch_id = " . $batch->batch_id . "
                                                                        AND trainee_id = " . $nomination->user_id . "";
                        $summary = $this->db->query($query)->row(); ?>
                        <td><?php echo $post_test =  $summary->total; ?></td>
                        <td><?php echo $pt_wrong_ans = $summary->wrong_ans; ?></td>
                        <td><?php echo $pt_correct_ans = $summary->correct_ans; ?></td>
                        <td><?php
                            if ($summary->total) {
                                echo @round(($summary->correct_ans * 100) / $summary->total, 2) . " %";
                            }
                            ?></td>
                        <td>
                            <?php if ($pt_wrong_ans > 0 and $pt_correct_ans > 0 and $post_test==($pt_wrong_ans+$pt_correct_ans)) { ?>
                                <?php

                                $query = "SELECT COUNT(*) as total FROM training_certificates 
                                WHERE training_id = '" . $training_id . "'
                                AND batch_id = '" . $batch_id . "'
                                AND trainee_id = '" . $nomination->user_id . "' ";
                                $trainee_certificate = $this->db->query($query)->row()->total;
                                ?>
                                <?php
                                if ($trainee_certificate == 0) { ?>
                                    <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . 'trainings/generate_certificate/' . $training_id . '/' . $batch_id . '/' . $nomination->user_id) ?>">Generate Certificate</a>
                                <?php } else { ?>
                                    <a target="_blank" class="btn btn-success btn-sm" href="<?php echo site_url(ADMIN_DIR . 'trainings/print_certificate/' . $training_id . '/' . $batch_id . '/' . $nomination->user_id) ?>">Print Certificate</a>
                                <?php } ?>
                            <?php } else { ?>
                                Tests Pending
                            <?php } ?>
                        </td>


                    </tr>


                <?php } ?>
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
            "ordering": false,
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