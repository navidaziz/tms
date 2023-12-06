<div class="modal-header">
    <h5 style="display: inline;" class="modal-title" id="g_modal_title"><?php echo $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="<?php echo site_url(ADMIN_DIR . "facilitator/add_mcq"); ?>" id="batch_add_form" method="post" enctype="multipart/form-data" style="font-size: 11px !important;">

        <input name="training_batch_session_id" type="hidden" value="<?php echo $training_batch_session_id; ?>" />
        <input name="training_id" type="hidden" value="<?php echo $training_id; ?>" />
        <input name="batch_id" type="hidden" value="<?php echo $batch_id; ?>" />
        <div class="form-group row">

            <div class="col-sm-12">
                <label for="document_detail" class="col-form-label">Document Detail</label>
                <input type="text" class="form-control" id="document_detail" name="document_detail" placeholder="Write About Document">
                <?php echo form_error("document_detail", "<p class=\"text-danger\">", "</p>"); ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <div>
                    <strong>Option A</strong>
                    <span class="pull-right">Correct Answer: <input type="radio" name="correct_answer" value="a" style="display:inline" /></span>
                </div>
                <input class="form-control" type="text" name="a" />
            </div>
            <div class="col-sm-12">
                <div>
                    <strong>Option B</strong>
                    <span class="pull-right">Correct Answer: <input type="radio" name="correct_answer" value="b" style="display:inline" /></span>
                </div>
                <input class="form-control" type="text" name="b" id="b" />

            </div>
            <div class="col-sm-12">
                <div>
                    <strong>Option C</strong>
                    <span class="pull-right">Correct Answer: <input type="radio" name="correct_answer" value="c" style="display:inline" /></span>
                </div>
                <input class="form-control" type="text" name="c" id="c" />
            </div>
            <div class="col-sm-12">
                <div>
                    <strong>Option D</strong>
                    <span class="pull-right">Correct Answer: <input type="radio" name="correct_answer" value="d" style="display:inline" /></span>
                </div>
                <input class="form-control" type="text" name="d" id="d" />
            </div>
        </div>
    </form>
</div>