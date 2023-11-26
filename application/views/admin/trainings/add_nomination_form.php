<div class="modal-header">
    <h5 style="display: inline;" class="modal-title" id="g_modal_title"><?php echo $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="nomination_form" method="post">
        <input name="training_id" type="hidden" value="<?php echo $training_id ?>" />
        <input name="nomination_type" type="hidden" value="<?php echo $nomination_type ?>" />
        <div class="form-group row">
            <label for="cnic" class="col-sm-4 col-form-label">CNIC</label>
            <div class="col-sm-5">
                <input id="user_id" type="hidden" value="" name="user_id" />
                <input type="text" id="cnic" pattern="\d{5}-\d{7}-\d{1}" required onKeyUp="nic_dash1(this)" class="form-control" name="cnic" placeholder="CNIC">
                <div id="message"></div>
            </div>
            <div class="col-sm-3">
                <button onclick="check_cnic(event)" class="btn btn-success btn-sm">Check CNIC</button>
                <script>
                    function check_cnic(event) {
                        $('#message').html('');
                        event.preventDefault();
                        var cnic = $('#cnic').val();
                        const pattern = /\d{5}-\d{7}-\d{1}/;

                        if (pattern.test(cnic)) {} else {
                            //alert("Error In CNIC");
                        }
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url(ADMIN_DIR . "/trainings/check_cnic"); ?>",
                            data: {
                                cnic: cnic
                            }
                        }).done(function(data) {
                            var jsonData = JSON.parse(data);
                            if (jsonData.error) {
                                $('#message').html(jsonData.error);
                            } else {
                                if (jsonData.user_id) {
                                    $('#user_id').val(jsonData.user_id);
                                    $('#name').val(jsonData.name);
                                    $('#father_name').val(jsonData.father_name);
                                    $('#qualification').val(jsonData.qualification);
                                    $('#department').val(jsonData.department);
                                    $('#designation').val(jsonData.designation);
                                    $('#district').val(jsonData.district);
                                    $('#address').val(jsonData.address);
                                    $('#user_mobile_number').val(jsonData.user_mobile_number);

                                } else {
                                    $('#message').html('<div class="text-success">No record found. Please enter detail</div>');
                                }
                            }

                        });
                    }
                </script>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="father_name" class="col-sm-4 col-form-label">Father Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father Name">
            </div>
        </div>

        <div class="form-group row">
            <label for="qualification" class="col-sm-4 col-form-label">Highest Qualification</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification">
            </div>
        </div>
        <div class="form-group row">
            <label for="department" class="col-sm-4 col-form-label">Department</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="department" name="department" placeholder="Department">
            </div>
        </div>
        <div class="form-group row">
            <label for="designation" class="col-sm-4 col-form-label">Designation</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
            </div>
        </div>

        <div class="form-group row">
            <label for="mobile_no" class="col-sm-4 col-form-label">Mobile Number</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="user_mobile_number" name="user_mobile_number" placeholder="Mobile Number">
            </div>
        </div>
        <div class="form-group row">
            <label for="district" class="col-sm-4 col-form-label">District</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="district" name="district" placeholder="District">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-sm-4 col-form-label">Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address">
            </div>
        </div>
        <div class="form-group row">
            <div style="text-align: center;">Do you want to nominate for this training? <input required type="radio" name="nomination" value="Yes" /> Yes
                <span required style="margin: 10px;"></span> <input type="radio" name="nomination" value="No" /> No
            </div>
        </div>
        <div id="message_form"></div>
        <button type="submit">Submit</button>

    </form>
    <script>
        $('#nomination_form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(ADMIN_DIR . "/trainings/add_nomination"); ?>',
                data: formData,
                success: function(data) {
                    var jsonData = JSON.parse(data);
                    if (jsonData.error) {
                        $('#message_form').html(jsonData.error);
                    }
                    if (jsonData.user_id) {
                        $('#message_form').html('<div class="text-success">Record Add Successfully.</div>');
                        //location.reload();
                    }
                    if (jsonData.update) {
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