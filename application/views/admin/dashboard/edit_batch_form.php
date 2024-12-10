<div class="modal-header">
    <h5 style="display: inline;" class="modal-title" id="g_modal_title"><?php echo $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="batch_edit_form" method="post">
        <input name="training_id" type="hidden" value="<?php echo $training_id ?>" />
        <input name="batch_id" type="hidden" value="<?php echo $batch->batch_id ?>" />

        <div class="form-group row">
            <label for="batch_title" class="col-sm-4 col-form-label">Batch Title</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="batch_title" name="batch_title" value="<?php echo $batch->batch_title ?>" placeholder="Title">
            </div>
        </div>
        <div class="form-group row">
            <label for="start_date" class="col-sm-4 col-form-label">Start Date</label>
            <div class="col-sm-8">
                <input min="<?php echo $training->start_date ?>" max="<?php echo $training->end_date; ?>" type="date" class="form-control" id="batch_start_date" name="batch_start_date" value="<?php echo $batch->batch_start_date ?>" placeholder="Start Date">
            </div>
        </div>
        <div class="form-group row">
            <label for="end_date" class="col-sm-4 col-form-label">End Date</label>
            <div class="col-sm-8">
                <input min="<?php echo $training->start_date ?>" max="<?php echo $training->end_date; ?>" type="date" class="form-control" id="batch_end_date" name="batch_end_date" value="<?php echo $batch->batch_end_date; ?>" placeholder="End Date">
            </div>
        </div>
        <div class="form-group row">
            <label for="location" class="col-sm-4 col-form-label">Location</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $batch->location ?>" placeholder="Location">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="detail">Detail</label>
                <textarea id="batch_detail" name="batch_detail" class="form-control"><?php echo $batch->batch_detail ?></textarea>
            </div>
        </div>


        <div id="message_form"></div>
        <div style="text-align: center;">
            <button class="btn btn-primary" type="submit">Update Batch Detail</button>
        </div>

    </form>
    <script>
        $('#batch_edit_form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(ADMIN_DIR . "/trainings/update_training_batch"); ?>',
                data: formData,
                success: function(data) {
                    window.location.search = '?tab=training';
                    var jsonData = JSON.parse(data);
                    if (jsonData.error) {
                        $('#message_form').html(jsonData.error);
                    }
                    if (jsonData.success) {
                        $('#message_form').html('<div class="text-success">Record Update Successfully.</div>');
                        //location.reload();
                    }

                },
                error: function(error) {
                    // Handle the error
                    console.error('Error:', error);
                }
            });
        });
    </script>
</div>