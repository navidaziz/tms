<div class="modal-header">
    <h5 style="display: inline;" class="modal-title" id="g_modal_title"><?php echo $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="training_certificates" class="form-horizontal" enctype="multipart/form-data" method="post">
        <input type="hidden" name="certificate_id" value="<?php echo $input->certificate_id; ?>" />

        <div class="form-group row">
            <label for="certificate_title" class="col-sm-4 col-form-label">Certificate Title</label>
            <div class="col-sm-8">
                <textarea id="certificate_title" name="certificate_title" class="form-control"><?php echo $input->certificate_title; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="certficate_sub_title" class="col-sm-4 col-form-label">Certificate Sub Title</label>
            <div class="col-sm-8">
                <textarea id="certficate_sub_title" name="certficate_sub_title" class="form-control"><?php echo $input->certficate_sub_title; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="certificate_for" class="col-sm-4 col-form-label">Certificate For</label>
            <div class="col-sm-8">
                <textarea id="certificate_for" name="certificate_for" class="form-control"><?php echo $input->certificate_for; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="awarded_to" class="col-sm-4 col-form-label">Awarded To</label>
            <div class="col-sm-8">
                <textarea id="awarded_to" name="awarded_to" class="form-control"><?php echo $input->awarded_to; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="training_title" class="col-sm-4 col-form-label">Training Title</label>
            <div class="col-sm-8">
                <textarea id="training_title" name="training_title" class="form-control"><?php echo $input->training_title; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="certificate_footer" class="col-sm-4 col-form-label">Certificate Footer</label>
            <div class="col-sm-8">
                <textarea id="certificate_footer" name="certificate_footer" class="form-control"><?php echo $input->certificate_footer; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="left_signatory" class="col-sm-4 col-form-label">Left Signatory</label>
            <div class="col-sm-8">
                <textarea id="left_signatory" name="left_signatory" class="form-control"><?php echo $input->left_signatory; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="right_signatory" class="col-sm-4 col-form-label">Right Signatory</label>
            <div class="col-sm-8">
                <textarea id="right_signatory" name="right_signatory" class="form-control"><?php echo $input->right_signatory; ?></textarea>
            </div>
        </div>

        <div class="form-group row" style="text-align:center">
            <div id="result_response"></div>
            <?php if ($input->certificate_id == 0) { ?>
                <button type="submit" class="btn btn-primary">Add Data</button>
            <?php } else { ?>
                <button type="submit" class="btn btn-primary">Update Data</button>
            <?php } ?>
        </div>
    </form>


    <script>
        // Initialize CKEditor for all textarea fields
        ClassicEditor
            .create(document.querySelector('#certificate_title'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#certficate_sub_title'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#certificate_for'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#awarded_to'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#training_title'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#certificate_footer'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#left_signatory'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#right_signatory'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $('#training_certificates').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(ADMIN_DIR . "trainings/update_facilitator_certificate"); ?>',
                data: formData,
                success: function(response) {
                    if (response == 'success') {
                        location.reload();
                    } else {
                        $('#result_response').html(response);
                    }
                }
            });
        });
    </script>


</div>
</div>