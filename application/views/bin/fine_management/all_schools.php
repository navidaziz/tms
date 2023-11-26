  <style type="text/css">
    tr td {
      font-size: 12px;
    }

    table tr td:not(:nth-child(1)) {
      font-size: 12px;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2 style="display:inline;">
        <?php echo @ucfirst($title); ?>
      </h2>
      <small><?php echo @$description; ?></small>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"> Home </a></li>
        <!-- <li><a href="#">Examples</a></li> -->
        <li class="active"><?php echo @ucfirst($title); ?>s</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">School <?php echo @ucfirst($title); ?></h3>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="pull-right margin-b">
            <!-- <a href="<?php echo base_url('school/create_form'); ?>" class="btn btn-flat btn-primary">Add new <?php echo @ucfirst($title); ?></a> -->
          </div>
          <?php $role_id = $this->session->userdata('role_id'); ?>
          <div class="row">
            <div class="col-md-12">
              <div class="">
                <!-- searching of schools by name and area wise -->
                <div class="clearfix"></div>
                <div id="area_and_like_box">
                  <div class="form-group">
                    <?php if (empty($district_id)) : ?>
                      <div class="col-sm-4">
                        <select class="form-control select2" id="district_id" name="district_id" onchange="getTehsilsByDistrictId(this);" required style="width: 100%;">
                          <?php echo $districts; ?>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <select class="form-control select2" name="tehsil_id" id="tehsil_id" style="width: 100%;" onchange="requiredOperationAfterTehsilChange(this);">
                          <option value="0">Select Tehsil</option>
                        </select>
                      </div>
                    <?php else : ?>
                      <input type="hidden" name="district_id" value="<?php echo $district_id; ?>" id="district_id">
                      <div class="col-sm-4">
                        <select class="form-control select2" name="tehsil_id" id="tehsil_id" style="width: 100%;" onchange="requiredOperationAfterTehsilChange(this);">
                          <option value="0">Select Tehsil</option>
                          <?php foreach ($tehsils as $tehsil) : ?>
                            <option value="<?php echo $tehsil->tehsilId; ?>"><?php echo $tehsil->tehsilTitle; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    <?php endif; ?>


                    <label class="col-sm-4">
                      <input type="text" class="form-control" name="like_text" onkeyup="getSchoolsByCreteria(this);" required="required" form="Form1" id="like_text" placeholder="Enter School Name" value="">
                    </label>
                  </div>
                </div>
                <div class="clearfix"></div> <!-- school Id search form-->
                <div id="by_school_id" class="bg-danger">
                  <form class="bg-danger" id="Form2" method="post" enctype="multipart/form-data" action="<?php echo base_url('fine_management/search_schools_by_creiteria'); ?>">
                    <div class="form-group">
                      <label class="col-sm-4">
                        <input type="number" class="form-control" name="schools_id" required="required" form="Form2" id="schools_id" placeholder="Enter School Id Examples 1,2,3 etc.">
                      </label>
                      <label class="col-sm-2">
                        <input type="submit" id="search" class="form-control btn-xs btn-primary btn-flat fa fa-search" form="Form2" value="Search">
                      </label>
                    </div>
                  </form>
                </div>
                <!-- end school id form here... -->

                <!-- end school area search... -->
                <!-- end searching code here -->
                <div class="clearfix"></div>
                <div class="table-responsive">


                  <table class="table table-responsive table-hover table-bordered table-condensed table-striped">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>School Name</th>
                      <th>Registration Number</th>
                      <th>Address</th>

                      <th>Type</th>

                      <th>School Level</th>
                      <th>School For</th>
                      <th>Phone#</th>
                      <th>Isfined</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <tbody id="searched_data_div">
                      <?php $counter = 1; ?>
                      <?php foreach ($schools as $school) : ?>
                        <tr>
                          <td><?php echo $school->schoolId; ?></td>
                          <td><b><?php echo $school->schoolName; ?></b></td>
                          <td><?php if ($school->registrationNumber == 0 || $school->registrationNumber == '') : ?>
                              <span class="text-danger">Not Registered</span>
                            <?php else : echo $school->registrationNumber;
                              endif; ?>
                          </td>
                          <td><?php if ($school->districtTitle != NULL) {
                                echo $school->districtTitle . ", " . $school->address;
                              } else {
                                echo $school->address;
                              }
                              ?>
                          </td>


                          <td><?php echo @$school->typeTitle; ?></td>

                          <td><?php echo @$school->levelofInstituteTitle; ?></td>
                          <td><?php echo $school->genderOfSchoolTitle; ?></td>
                          <td><?php echo $school->telePhoneNumber; ?></td>
                          <td id="<?php echo $school->schoolId; ?>"><?php if ($school->isfined == 1) echo "<span class='label label-danger'>Yes</span>";
                                                                    else echo "<span class='label label-success'>No</span>"; ?></td>
                          <td class="text-center">
                            <button title="Fine Setting" id="<?php echo $school->schoolId; ?>" class="btn btn-primary btn-xs fine_details"><i class="  fa fa-gear "></i></button>
                            <br>
                            <button title="Send Message" school="<?php echo @$school->schoolName; ?>" id="<?php echo @$school->schoolId; ?>" class="send fa fa-envelope-o btn btn-warning btn-xs "></button>

                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <?= $this->pagination->create_links(); ?>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal -->
  <div class="modal fade" id="fine_details_modal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #00a65a;color:#fff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_one_title">title will be goes dynamically</h4>
        </div>
        <div id="modal_one_content_goes_here">

        </div>
      </div>

    </div>
  </div>

  <div class="modal fade" id="send_message_modal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #00a65a;color:#fff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="send_message_modal_title">Send Message</h4>
        </div>
        <div id="send_message_modal_contents">
          <style type="text/css">
            .bold {
              font-weight: bold;
            }

            .upload-btn-wrapper {
              position: relative;
              overflow: hidden;
              display: inline-block;
            }

            .btn-upload {
              border: 2px dotted gray;
              color: #1d42ab;
              background-color: white;
              padding: 8px 20px;

              font-size: 20px;
              font-weight: bold;
              width: 100%;
              height: 150px;
              border: 1px solid #DDDDDD;
              background: #FAFAFA;
            }

            .upload-btn-wrapper input[type=file] {
              font-size: 100px;
              position: absolute;
              left: 0;
              top: 0;
              opacity: 0;
            }

            .panel-heading {
              padding: 5px;
            }

            input[type="checkbox"] {
              border: 1px solid red;
            }
          </style>
          <!-- Default unchecked -->
          <script src="<?= base_url('ckeditor/ckeditor.js') ?>"></script>
          <!-- Content Wrapper. Contains page content -->
          <div class="content-fluid">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box box-primary box-solid">

                <div class="box-body">
                  <div class="row">
                    <?php echo validation_errors(); ?>
                    <div class="col-md-12">
                      <div class="  form-group col-sm-12">


                        <div style="margin-left:10px;/'" class="well well-sm" id="selection">Message Send To :
                          <b style="font-size: 20px;" class="text-success" id="selected_schools"></b>
                        </div>


                      </div>
                      <form id="myForm" method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" form="myForm" name="school_id_for_message" id="school_id_for_message">
                        <div class="box-body">
                          <div class="  form-group col-sm-12">
                            <div class="">
                              <label for="subject" class=" control-label">Subject</label>
                              <input type="text" form="myForm" required="required" placeholder="Subject" name="subject" id="subject" class="form-control"><?php echo set_value('discription'); ?>
                            </div>

                          </div>
                          <div class="  form-group col-sm-12">
                            <div class="">
                              <label for="name" class=" control-label">Type Your Message Here</label>
                              <textarea form="myForm" required="required" placeholder="Type Your Message Here" name="discription" id="editor1" class="form-control" rows="3"><?php echo set_value('discription'); ?></textarea>
                            </div>

                          </div>

                          <div class="form-group col-sm-12">

                            <div id="images_preview" class=""></div>
                            <div id="images_preview_exceed_error" class="text-danger"></div>
                            <div class="clearfix col-sm-12">
                              <div class="upload-btn-wrapper">
                                <button onclick="return check_images_number()" class="btn-upload"><i class="fa fa-file"></i> Attach Files</button>
                                <input accept="image/*,.pdf,.doc,.docx" onclick="return check_images_number()" type="file" id="otherimages" name="otherimages" multiple="multiple">
                              </div>





                            </div>
                            <div id="limit_message">You can Upload Maximum 5 Files</div>
                          </div>






                          <div class="form-group">
                            <div class="pull-right">
                              <button style="background-color: #F4731E;border-color: #F4731E;color: #FFFFFF;" type="submit" class="btn btn-primary btn-flat">Send Message</button>
                            </div>
                          </div>




                        </div>









                        <!-- radio for status -->



                    </div>

                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- Footer -->
              </div>
              <!-- /.box-footer-->
          </div>
          <!-- /.box -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Modal -->


        </form>
        <script type="text/javascript">
          $(document).ready(function() {
            // Find and remove selected table rows
            $("#schools").click(function(e) {
              e.preventDefault();
              $('#modal_one').modal('show');
              return false;
            });
          });
          $(document).ready(function() {

            $('#select_all').on('click', function() {
              if (this.checked) {
                $('.checkbox').each(function() {
                  this.checked = true;

                });
              } else {
                $('.checkbox').each(function() {
                  this.checked = false;
                });
              }
            });

          });
        </script>
        <script>
          // Replace the <textarea id="editor1"> with a CKEditor
          // instance, using default configuration.
          CKEDITOR.replace('editor1');
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#level_id').on('change', function() {
              filter();
            });
          });
          $(document).ready(function() {
            $('#district').on('change', function() {
              filter();
            });
          });

          function filter() {
            var district_id = 0;
            var level_id = 0;
            district_id = $("#district").val();
            level_id = $("#level_id").val();
            var string = $("#like_text").val();
            // console.log(likObjValue);
            $.ajax({
              type: 'POST',
              url: "<?php echo base_url('messages/filter_schools_by_level_and_district'); ?>",
              data: {
                "matchString": string,
                "district": district_id,
                "level": level_id
              },
              success: function(data) {
                $("#filter_schools").html(data);
                $('#select_all').prop('checked', false);
                //console.log(data);


              },
              error: function(error) {
                alert("Error occur:" + error);
              }
            });
          }
          $('#done').on('click', function() {
            //alert();
            var district_value = $('#district').val();
            var level_value = $('#level_id').val();
            var district_text = $('#district option:selected').text();
            var level_text = $('#level_id option:selected').text();
            ///////////////////////////////////////
            if (district_value == 0) {
              district_text = '';
            } else {
              district_text = "In " + district_text;
            }
            if (level_value == 0) {
              level_text = '';
            }
            //////////////////////////////////////////
            if ($("#select_all").is(":checked")) {
              var total_selected_schools = " All " + level_text + " Schools " + district_text;
              $('#selected_schools').html(total_selected_schools);
            } else {
              var selected = [];
              $("input[name='ids[]']:checked").each(function() {
                selected.push($(this).val());
              });
              var total_selected_schools = selected.length + " " + level_text + " Schools " + district_text;
              $('#selected_schools').html(total_selected_schools);
            }
            $('#selection').show();
            $('#modal_one').modal('hide');
            //console.log(selected);
          });
          /////////////
          // $('#myForm').on('submit', function(e) {
          // e.preventDefault();
          //  var messageLength = CKEDITOR.instances['editor1'].getData().replace(/<[^>]*>/gi, '').length;
          //             if( !messageLength ) {
          //                 alert( 'Please enter a message' );
          //                 e.preventDefault();
          //                 return 0;
          //             }
          // $.ajax({
          // type: 'POST',
          // url: "<?php //echo base_url('messages/index'); 
                    ?>",
          // data: $('#myForm').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
          // success: function(data){
          // console.log(data);
          // // try{
          // //      obj = $.parseJSON(data);
          // // }
          // // catch (e)
          // // {
          // //   location.reload();
          // // }


          // },
          // error:function (data) {
          // alert("Enrollement data error:"+data);
          // }
          // });
          // });



          //////////////
        </script>

        <script>
          function check_images_number() {
            if (storedFiles.length == 5) {
              return false;
            }
          }
          var selDiv = "";
          var storedFiles = [];

          $(document).ready(function() {
            $("#otherimages").on("change", handleFileSelect);

            selDiv = $("#images_preview");
            $("#myForm").on("submit", handleForm);

            $("body").on("click", ".selFile", removeFile);
          });

          function handleFileSelect(e) {
            $('#limit_message').html('');

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            filesArr.forEach(function(f) {
              if (!f.type.match("image.*") && !f.type.match(".pdf") && !f.type.match("application/msword") && !f.type.match(".doc")) {
                return;
              }
              if (storedFiles.length < 5) {
                storedFiles.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                  var html = "<div class='col-md-6 clearfix' style='padding:5px;'><p class=' btn-success text-primary' style='margin-top:30px;padding:10px;padding-right:30px;border:1px solid gray;overflow: hidden;text-overflow: ellipsis;'>" + f.name + "</p><a style='position: absolute;right: 10px;color: #fff;opacity: .8;width: 22px;height: 22px;top: 40px;text-align: center;' href='javascript:void(0);' class='selFile' data-file='" + f.name + "'><i class='fa fa-close'></i></a></div>";
                  selDiv.append(html);

                }
                reader.readAsDataURL(f);
              }


            });

          }

          function handleForm(e) {

            e.preventDefault();
            var messageLength = CKEDITOR.instances['editor1'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {
              alert('Please enter a message');
              e.preventDefault();
              return false;
            }
            for (var instanceName in CKEDITOR.instances)
              CKEDITOR.instances[instanceName].updateElement();
            $("#failed_alert").hide();
            $("#success_alert").hide();

            var form = $('form')[1]; // You need to use standard javascript object here
            var formdata = new FormData(form);
            //console.log(formdata);
            for (var i = 0, len = storedFiles.length; i < len; i++) {
              formdata.append('otherimages[' + i + ']', storedFiles[i]);
            }

            $.ajax({
              type: 'POST',
              url: "<?php echo base_url('messages/send_message_to_single_school') ?>",
              data: formdata,
              contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
              processData: false,
              success: function(data) {
                console.log(data);
                try {
                  // handle json here


                  obj = $.parseJSON(data);
                  if (obj.status == false) {
                    alert(obj.msg);
                  } else if (obj.status == true) {
                    alert(obj.msg);

                    $("#myForm").trigger('reset');
                    for (instance in CKEDITOR.instances) {
                      CKEDITOR.instances[instance].updateElement();
                      CKEDITOR.instances[instance].setData('');
                    }

                    $("#images_preview").html('');
                    storedFiles = [];


                  }

                } catch (e) {
                  location.reload();
                  //console.log(data);
                }
              },








              error: function(data) {
                // alert("getUcsByTehsilsId :s"+data);
                alert("Failed");
              }
            });
          }

          function removeFile(e) {
            var file = $(this).data("file");
            for (var i = 0; i < storedFiles.length; i++) {
              if (storedFiles[i].name === file) {
                storedFiles.splice(i, 1);

                break;
              }
            }
            $(this).parent().remove();
          }
        </script>

      </div>
    </div>

  </div>
  </div>



  <script type="text/javascript">
    $(".fine_details").on('click', function() {
      var id = $(this).attr('id');
      //$(this).closest("tr").html("");
      //alert(id);
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('fine_management/get_school_fine_details') ?>",
        data: {
          "id": id
        },

        success: function(data) {

          try {
            obj = $.parseJSON(data);
            $('#fine_details_modal').modal('show');
            $("#modal_one_content_goes_here").html("");
            $("#modal_one_content_goes_here").html(obj.school_info);
            $("#modal_one_title").html("School Fine Details");
          } catch (e) {
            location.reload();
          }


        },
        error: function(data) {
          // alert("getUcsByTehsilsId :s"+data);

        }

      });
      // $('#myModal').modal('show');


    });
  </script>
  <script type="text/javascript">
    $(".send").on('click', function() {
      var id = $(this).attr('id');
      $('#school_id_for_message').val(id);
      var school = $(this).attr('school');

      $('#selected_schools').html(school);
      $('#send_message_modal').modal('show');

      $("#myForm").trigger('reset');
      for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
        CKEDITOR.instances[instance].setData('');
      }

      $("#images_preview").html('');
      storedFiles = [];
      //alert(id);



    });
  </script>
  <script type="text/javascript">
    function getTehsilsByDistrictId(selected) {
      $("#like_text").val('');
      $("select.select2").select2('data', {}); // clear out values selected
      $("select.select2").select2({
        allowClear: true
      }); // re-init to show default status
      $.ajax({
        type: 'GET',
        url: "<?php echo base_url('fine_management/get_tehsils_list_by_district_id') ?>/" + selected.value,
        //data: {"id": id},
        success: function(data) {

          $("#tehsil_id").html(data);

        },
        error: function(error) {
          alert("getTehsilsByDistrictId" + error);
        }

      });
    }

    function requiredOperationAfterTehsilChange(selected) {
      $("#like_text").val('');

    }

    function getSchoolsByCreteria(likeObj) {
      var likObjValue = '';
      var district_id = 0;
      var tehsil_id = 0;
      likObjValue = likeObj.value;
      district_id = $("#district_id").val();
      tehsil_id = $("#tehsil_id").val();
      // console.log(likObjValue);
      if (likObjValue.length > 4) {
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('fine_management/search_schools_by_creiteria'); ?>",
          data: {
            "matchString": likObjValue,
            "district_id": district_id,
            "tehsil_id": tehsil_id
          },
          success: function(data) {
            console.log(data);
            try {
              obj = $.parseJSON(data);
              $('tr.bg-success').remove();
              $('#searched_data_div').prepend(obj.rows);
            } catch (e) {
              location.reload();
            }

          },
          error: function(error) {
            alert("Error occur:" + error);

          }
        });
      } else {
        $('tr.bg-success').remove();
      }
    }
  </script>

  <script type="text/javascript">
    $('form[id="Form2"] input:submit').on('click', function(e) {
      e.preventDefault();
      $("#search").prop('disabled', true);
      $("#search").val("Please Wait...");
      $('#create_school_user_process_response').html('');
      $('#create_school_user_process_response_alert').html('');

      $.ajax({
        type: 'POST',
        url: $('#Form2').attr('action'),
        data: $('#Form2').serialize(), // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
        success: function(data) {

          console.log(data);
          try {
            obj = $.parseJSON(data);
            $('tr.bg-success').remove();
            $('#searched_data_div').prepend(obj.rows);
            $("#search").val("Search");
            $("#search").prop('disabled', false);
          } catch (e) {
            location.reload();
          }


        },
        error: function(data) {
          alert("search failed :" + data);
          $("#search").val("Search");
          $("#search").prop('disabled', false);

        }
      });


      // return false;
    });
  </script>