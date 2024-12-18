<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mockup</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include Highcharts library from CDN -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

</head>

<style>
        .dashboard-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 5px;
            margin: 10px 0;
            transition: transform 0.2s;
        }
        .dashboard-box:hover {
            transform: scale(1.05);
        }
        .dashboard-box h3 {
            margin: 0;
            font-size: 10px;
            font-weight: bold;
            color: #333;
        }
        .dashboard-box p {
            font-size: 14px;
            color: #777;
        }
        .dashboard-box .count {
            font-size: 15px;
            font-weight: bold;
            color: #2c3e50;
        }
        .table_small>tbody>tr>td,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>td,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>thead>tr>th {
        padding: 2px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px;
        text-align: center;
        border: 0.1px solid gray !important;
        font-weight: bold !important;
        color: black !important;
    }
</style>

<body>

<!-- Dashboard Content -->
<div style="margin: 10px auto;">
    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-box">
                <h3><strong>Training Management System</strong></h3>
                <h4>HCIP (Health)</h4>
                <p class="count">Data Analysis Dashboard</p>
                <p><a href="<?php echo site_url(ADMIN_DIR.'/trainings  '); ?>" ><i class="fa fa-home"></i> Home</a> - 
                <a href="<?php echo site_url(ADMIN_DIR."login/logout"); ?>" >Logout <i class="fa fa-sign-out"></i></a> </p>
            </div>
        </div>
        <div class="col-md-9">
        <div class="dashboard-box" style="text-align:left !important">
    <h3>Data Summary</h3>
    <?php 
    $query="SELECT COUNT(*) as total FROM trainings";
    $total_trainings = $this->db->query($query)->row()->total;
    $query="SELECT  
    SUM(IF(u.role_id = 4 and u.gender = 'Male',1,0)) as male_trainees,
    SUM(IF(u.role_id = 4 and u.gender = 'Female',1,0)) as female_trainees,
    SUM(IF(u.role_id = 3 and u.gender = 'Male',1,0)) as male_facilitators,
    SUM(IF(u.role_id = 3 and u.gender = 'Female',1,0)) as female_facilitators
    FROM users as u";
    $users = $this->db->query($query)->row();
    $query = "SELECT 
    (AVG(trainings_hall_environment) + AVG(food) + AVG(hostel) + AVG(extra_physical_activities)) / 4 AS avg_rating
    FROM 
    facilities_evaluations";
    $facilities_rating = $this->db->query($query)->row()->avg_rating;
    $query = "SELECT 
    (AVG(fe.subject_knowledge) + AVG(fe.lecture_contents) + AVG(fe.teaching_methodology) + AVG(fe.time_utilization) + AVG(fe.participants_engagement)) / 5 AS avg_rating
    FROM training_nominations
    INNER JOIN users ON(users.user_id = training_nominations.user_id)
    INNER JOIN facilitator_evaluations fe ON(fe.facilitator_id = users.user_id)
    WHERE training_nominations.nomination_type = 'Facilitator'";
    $facilitators_rating = $this->db->query($query)->row()->avg_rating;
    ?>
    <p id="typewriter-text"></p>

<script>
// The text you want to display (can be PHP-generated dynamically)
const text = `So far, a total of <?php echo $total_trainings; ?> trainings have been conducted, 
with <?php echo $users->male_trainees + $users->female_trainees ?> trainees in total, 
including <?php echo $users->male_trainees ?> males and <?php echo $users->female_trainees ?> females. 
These trainings covered various categories and were delivered by <?php echo $users->male_facilitators + $users->female_facilitators ?> facilitators, 
including <?php echo $users->male_facilitators ?> male and <?php echo $users->female_facilitators ?> female facilitators. 
On average, facilitators received an average rating of <?php echo round($facilitators_rating, 1); ?>, 
while the overall trainee satisfaction level averages at <?php echo round($facilities_rating, 1); ?> for facilities provided.`;

// Function to create the typewriter effect
function typeWriter(elementId, text, speed) {
  let i = 0;
  const element = document.getElementById(elementId);

  function type() {
    if (i < text.length) {
      element.innerHTML += text.charAt(i);
      i++;
      setTimeout(type, speed); // Call the function recursively with a delay
    }
  }

  type(); // Start typing
}

// Call the typewriter effect function on page load
window.onload = function() {
  typeWriter('typewriter-text', text, 10); // Speed of typing (ms per character)
};
</script>

        <!-- <p>The data shows a significant improvement in performance between the pre-test and post-test. Out of 23,210 total multiple-choice questions, the individual answered 10,846 questions correctly on the pre-test, which is 46.73%. After some form of learning or intervention, they answered 17,312 questions correctly on the post-test, which is 74.59%. This demonstrates a marked increase in the percentage of correct answers, indicating that the individual’s knowledge or skills improved substantially after the intervention.</p> -->
</div>

        </div>
    </div>

    <div class="row">
    <div class="col-md-3">
            <div id="training_type"></div>
        </div>
    <div class="col-md-3">
            <div id="training_locality_level"></div>
        </div>
        <div class="col-md-3">
            <div id="training_categories"></div>
        </div>
        <div class="col-md-3">
            <div id="sub_categories"></div>
        </div>
        <div class="col-md-4">
            <div id="training_for"></div>
        </div>
        <div class="col-md-4">
            <div id="designation_wise_trainees"></div>
        </div>
        <div class="col-md-4">
            <div id="cader_wise_trainees"></div>
        </div>
        
    </div>
    <div class="row">
    <div class="col-md-4">
            <div id="facilitators_gender_wise"></div>
        </div>
        <div class="col-md-4">
            <div id="trainees_gender_wise"></div>
        </div>
        <div class="col-md-4">
            <div id="pre_post_tests"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div id="facilities_rating"></div>
        </div>
        <div class="col-md-6">
            <div id="facilitators_rating"></div>
        </div>
        

       

        <div class="col-md-12">
            <div id="district_wise_trainees"></div>
        </div>
        
       
        
        
       
        
        
        
        
    </div>
</div>

   
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        function get_report(funcation_name) {
            $('#' + funcation_name).html('<h5 style="text-align: center;" class="loading"></h5>');
            var checkedFYIds = [];
            var checkboxes = document.querySelectorAll('.fy_id');
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const fyId = checkbox.getAttribute('name').match(/\d+/)[0];
                    checkedFYIds.push(fyId);
                }
            });

            $.ajax({
                    method: "POST",
                    url: "<?php echo site_url('admin/md_dashboard/'); ?>" + funcation_name,
                    data: {
                        fy_ids: checkedFYIds
                    }
                })
                .done(function(respose) {
                    $('#' + funcation_name).html(respose);
                });
        }

        function filter_data() {

            get_report("facilities_rating");
            get_report("facilitators_rating");
            get_report("trainees_gender_wise");
            get_report("facilitators_gender_wise");
            get_report("district_wise_trainees");
            get_report("pre_post_tests");
            get_report("training_locality_level");
            get_report("designation_wise_trainees");
            get_report("cader_wise_trainees");
            get_report("training_type");
            get_report("training_categories");
            get_report("sub_categories");
            get_report("training_for");
            
            
            
            
            
            
            

        }
        filter_data();
    </script>

    <script>
        function makeFullScreen(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) { // Firefox
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) { // Chrome, Safari, Opera
                    element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) { // IE/Edge
                    element.msRequestFullscreen();
                }
            } else {
                console.warn(`Element with id "${elementId}" not found.`);
            }
        }

        
    </script>

</body>

</html>