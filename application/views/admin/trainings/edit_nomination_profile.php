<div class="modal-header">
    <h5 style="display: inline;" class="modal-title" id="g_modal_title"><?php echo $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="profile_update" method="post">
        <?php
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $user = $this->db->query($query)->row();
        ?>
        <input name="user_id" type="hidden" value="<?php echo $user_id ?>" />
        <div class="form-group row">
            <label for="cnic" class="col-sm-4 col-form-label">CNIC</label>
            <div class="col-sm-8">
                <input value="<?php echo $user->cnic; ?>" type="text" id="cnic" pattern="\d{5}-\d{7}-\d{1}" required onKeyUp="nic_dash1(this)" class="form-control" name="cnic" placeholder="CNIC">
                <div id="message"></div>
            </div>

        </div>
        <div class="form-group row">
            <label for="user_password" class="col-sm-4 col-form-label">Account Password</label>
            <div class="col-sm-8">
                <input type="text" value="<?php echo $user->user_password; ?>" class="form-control" id="user_password" name="user_password" placeholder="Biometric ID">
            </div>
        </div>
        <div class="form-group row">
            <label for="biometric_id" class="col-sm-4 col-form-label">Biometric ID</label>
            <div class="col-sm-8">
                <input type="text" value="<?php echo $user->biometric_id; ?>" class="form-control" id="biometric_id" name="biometric_id" placeholder="Biometric ID">
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
                <input value="<?php echo $user->name; ?>" type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="father_name" class="col-sm-4 col-form-label">Father Name</label>
            <div class="col-sm-8">
                <input value="<?php echo $user->father_name; ?>" type="text" class="form-control" id="father_name" name="father_name" placeholder="Father Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="father_name" class="col-sm-4 col-form-label">Gender</label>
            <div class="col-sm-8">
                <input <?php if ($user->gender == 'Male') { ?>checked<?php } ?> required type="radio" id="male" name="gender" value="Male"> Male
                <span style="margin: 5px;"></span>
                <input <?php if ($user->gender == 'Female') { ?>checked<?php } ?> required type="radio" id="female" name="gender" value="Female"> Female
            </div>
        </div>

        <div class="form-group row">
            <label for="qualification" class="col-sm-4 col-form-label">Highest Qualification</label>
            <div class="col-sm-8">
                <input value="<?php echo $user->qualification; ?>" type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification">
            </div>
        </div>
        <div class="form-group row">
            <label for="department" class="col-sm-4 col-form-label">Department</label>
            <div class="col-sm-8">
                <input value="<?php echo $user->department; ?>" type="text" class="form-control" id="department" name="department" placeholder="Department">
            </div>
        </div>
        <div class="form-group row">
            <label for="duty_station" class="col-sm-4 col-form-label">Duty Station</label>
            <div class="col-sm-8">
                <input required type="text" value="<?php echo $user->duty_station; ?>" class="form-control" id="duty_station" name="duty_station" placeholder="Duty Station">
            </div>
        </div>
        <div class="form-group row">
            <label for="designation" class="col-sm-4 col-form-label">Designation</label>
            <div class="col-sm-8">
                <input type="text" value="<?php echo $user->designation; ?>" class="form-control" id="designation" name="designation" placeholder="Designation">
            </div>
        </div>

        <div class="form-group row">
            <label for="mobile_no" class="col-sm-4 col-form-label">Mobile Number</label>
            <div class="col-sm-8">
                <input onfocus="addCountryCode()" minlength="13" maxlength="13" onkeydown="addCountryCode()" type="phone" value="<?php echo $user->user_mobile_number; ?>" class="form-control" id="user_mobile_number" name="user_mobile_number" placeholder="Mobile Number">
            </div>
            <script>
                function addCountryCode() {
                    var mobileNumberInput = document.getElementById('user_mobile_number');
                    // Check if the input doesn't already start with '+923'
                    if (!mobileNumberInput.value.startsWith('+923')) {
                        mobileNumberInput.value = '+923' + mobileNumberInput.value;
                    }
                }
            </script>
        </div>
        <div class="form-group row">
            <label for="district" class="col-sm-4 col-form-label">District</label>
            <div class="col-sm-8">
                <input type="text" value="<?php echo $user->district; ?>" class="form-control" id="district" name="district" placeholder="District">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-sm-4 col-form-label">Address</label>
            <div class="col-sm-8">
                <input type="text" value="<?php echo $user->address; ?>" class="form-control" id="address" name="address" placeholder="Address">
            </div>
        </div>

        <div id="message_form"></div>
        <div style="text-align: center;">
            <button class="btn btn-primary btn-sm" type="submit"><?php echo $title; ?></button>
        </div>

    </form>
    <script>
        $('#profile_update').submit(function(e) {
            e.preventDefault();
            var mobileNumberInput = document.getElementById('user_mobile_number');
            // Check if the input doesn't already start with '+923'
            if (!mobileNumberInput.value.startsWith('+923')) {
                alert("Please enter correct mobile number. must start with +923");
                return false;
            }
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(ADMIN_DIR . "/trainings/profile_update"); ?>',
                data: formData,
                success: function(data) {
                    window.location.search = '?tab=nomination';
                    //location.reload();
                    var jsonData = JSON.parse(data);
                    if (jsonData.error) {
                        $('#message_form').html(jsonData.error);
                    }

                    if (jsonData.update) {
                        $('#message_form').html('<div class="text-success">Record Update Successfully.</div>');
                        location.reload();
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
</div>