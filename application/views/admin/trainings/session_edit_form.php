<div class="modal-header">
    <h5 style="display: inline;" class="modal-title" id="g_modal_title"><?php echo $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <h4>
        Session for : <?php echo date('D d F, Y', strtotime($batch_day)); ?>
    </h4>
    <form id="update_batch_session" method="post">
        <input name="training_id" type="hidden" value="<?php echo $training_id ?>" />
        <input name="batch_id" type="hidden" value="<?php echo $batch_id ?>" />
        <input name="training_batch_session_id" type="hidden" value="<?php echo $training_batch_session_id ?>" />

        <div class="form-group row">
            <label for="start_time" class="col-sm-4 col-form-label">Start Time</label>
            <div class="col-sm-8">
                <input required type="time" class="form-control" id="start_time" name="start_time" value="<?php echo $training_batch_session->start_time ?>" placeholder="Start Time">
            </div>
        </div>
        <div class="form-group row">
            <label for="end_time" class="col-sm-4 col-form-label">End Time</label>
            <div class="col-sm-8">
                <input required type="time" class="form-control" id="end_time" name="end_time" value="<?php echo $training_batch_session->end_time ?>" placeholder="End Time">
            </div>
        </div>
        <div class="form-group row">
            <label for="activity_type" class="col-sm-4 col-form-label">Activity OR Break</label>
            <div class="col-sm-8">
                <input <?php if ($training_batch_session->activity_type == 'Activity') { ?> checked <?php } ?> onclick="activity()" required type="radio" name="activity_type" value="Activity" /> Activity
                <span style="margin-right: 5px;"></span>
                <input <?php if ($training_batch_session->activity_type == 'Break') { ?> checked <?php } ?> onclick="a_break()" required type="radio" name="activity_type" value="Break" /> Break
            </div>
        </div>
        <div class="activity_div">
            <div class="form-group row">
                <label for="course_category" class="col-sm-4 col-form-label">Course Category</label>
                <div class="col-sm-8">
                    <input required type="text" class="form-control activity" id="course_category" name="course_category" value="<?php echo $training_batch_session->course_category ?>" placeholder="Course Category">
                </div>
            </div>
            <div class="form-group row">
                <label for="course_type" class="col-sm-4 col-form-label">Course Type</label>
                <div class="col-sm-8">
                    <input required type="text" class="form-control activity" id="course_type" name="course_type" value="<?php echo $training_batch_session->course_type ?>" placeholder="Course Type">
                </div>
            </div>
            <div class="form-group row">
                <label for="course_title" class="col-sm-4 col-form-label">Course Title</label>
                <div class="col-sm-8">
                    <input required type="text" class="form-control activity" id="course_title" name="course_title" value="<?php echo $training_batch_session->course_title ?>" placeholder="Course Title">
                </div>
            </div>
            <div class="form-group row">
                <label for="facilitotor_id" class="col-sm-4 col-form-label">Facilitator</label>
                <div class="col-sm-8">
                    <?php
                    $query = "SELECT users.*, training_nominations.nomination_type
                 FROM training_nominations
                 INNER JOIN users ON(users.user_id = training_nominations.user_id)
                 WHERE  training_nominations.nomination_type='Facilitator'
                 AND training_nominations.batch_id = $batch_id
                 AND training_nominations.training_id = " . $training_id;
                    $facilitators = $this->db->query($query)->result();
                    ?>
                    <?php
                    if (!$facilitators) {
                        echo '<div class="alert alert-danger">Note: Please ensure the nomination of facilitators for the training. Without the facilitator nomination, you won\'t be able to add a session for this batch.</div>';
                    }
                    ?>
                    <select class="form-control activity" name="facilitator_id">
                        <option value="">Select Facilitor</option>
                        <?php foreach ($facilitators as $facilitator) { ?>
                            <option <?php if ($training_batch_session->facilitator_id == $facilitator->user_id) { ?> selected <?php } ?> value="<?php echo $facilitator->user_id ?>"><?php echo $facilitator->name; ?> (<?php echo $facilitator->designation; ?>)</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="break_div" style="display: none;">
            <div class="form-group row">
                <label for="break_detail" class="col-sm-4 col-form-label">Break Detail</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control break" id="break_detail" name="break_detail" value="<?php echo $training_batch_session->break_detail ?>" placeholder="Break Detail">
                </div>
            </div>
        </div>

        <div id="message_form"></div>
        <div style="text-align: center;">
            <button class="btn btn-primary" type="submit">Update Session Detail</button>
        </div>

    </form>
    <script>
        function activity() {
            $('.break').attr('required', false);
            $('.activity').attr('required', true);
            $('.activity_div').show();
            $('.break_div').hide();

        }

        function a_break() {
            $('.break').attr('required', true);
            $('.activity').attr('required', false);
            $('.activity_div').hide();
            $('.break_div').show();

        }
        $('#update_batch_session').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(ADMIN_DIR . "/trainings/update_batch_session"); ?>',
                data: formData,
                success: function(data) {
                    var jsonData = JSON.parse(data);
                    if (jsonData.error) {
                        $('#message_form').html(jsonData.error);
                    }
                    if (jsonData.success) {
                        $('#message_form').html('<div class="text-success">Record Update Successfully.</div>');
                        location.reload();
                    }

                },
                error: function(error) {
                    // Handle the error
                    console.error('Error:', error);
                }
            });
        });
        <?php if ($training_batch_session->activity_type == 'Break') { ?>
            a_break();
        <?php } ?>
        <?php if ($training_batch_session->activity_type == 'Activity') { ?>
            activity();
        <?php } ?>
    </script>
</div>