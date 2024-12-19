<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Delivery Patch Print</title>
    <link rel="stylesheet" href="style.css">
    <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
    <script src="script.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/cloud-admin.css" media="screen,print" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/themes/default.css" media="screen,print" id="skin-switcher" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/responsive.css" media="screen,print" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/custom.css" media="screen,print" />


    <style>
        body {
            background: rgb(204, 204, 204);

            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;

        }



        element.style {
            color: black;
            font-weight: bold;
        }


        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);

        }



        page[size="A4"] {
            width: 21cm;
            /* height: 29.7cm; */
            height: auto;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
                color: black;
                width: 99% !important;

            }



        }


        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 4px;
            line-height: 1;
            vertical-align: top;
            border-top: 1px solid #ddd;
            font-size: 12px !important;
            color: black;
        }

        /* Styles go here */
        @media screen {
            .print-page-header {
                height: auto;
                display: none;
            }
        }




        @media screen {
            .page-footer {
                height: 50px;
                display: none;
            }
        }



        @media print {
            .page-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                border-top: 1px solid gray;
                /* for demo */
                content: counter(page) " of " counter(pages);
                /* for demo */
            }

            .page-footer-space {
                height: 80px;

            }
        }

        @media screen {
            .page-footer {
                position: relative;

                width: 100%;
                border-top: 1px solid gray;
                /* for demo */
                display: block;
                /* for demo */
            }

            .page-footer-space {
                height: 80px;
                display: none;
            }
        }

        @media print {
            .print-page-header {
                position: fixed;
                top: 0mm;
                width: 100%;
                background: yellow;
                /* for demo */
                /* for demo */
            }

            .print-page-header-space {
                height: 100px;
            }
        }

        @media screen {
            .print-page-header {
                position: relative;
                top: 0mm;
                width: 100%;
                display: block;
                /* for demo */
                /* for demo */
            }

            .print-page-header-space {
                height: 0px;
                display: none;
            }
        }




        .page {
            page-break-after: always;
        }



        @page {
            margin: 20mm
        }

        @media print {
            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }

            button {
                display: none;
            }

            body {
                margin: 0;
                background-color: white !important;
            }

            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: none !important;

            }
        }
    </style>
</head>

<body>
    <page size='A4'>

        <div class="print-page-header" style="background-color: rgb(229, 228, 226) !important;">

        </div>


        <div style="padding-left: 20px; padding-right: 16px; padding-top:10px !important;" contenteditable="true">
            <table style="width: 100%;" style="color:black">
                <thead>
                    <tr>
                        <th style="text-align: center;">
                            <table style="width:100%">
                                <tr>
                                    <td style="padding-top: 10px; width: 90px !important;">
                                        <img src="<?php echo site_url("assets/uploads/" . $system_global_settings[0]->sytem_admin_logo); ?>" alt="<?php echo $system_global_settings[0]->system_title ?>" title="<?php echo $system_global_settings[0]->system_title ?>" style="width:80px !important" />
                                    </td>
                                    <td style="vertical-align: top; text-align:center; margin-right:10px; ">
                                        <h4 style="color:black; font-weight: bold"><?php echo $system_global_settings[0]->system_title ?> </h4>
                                        <small><strong><?php echo $system_global_settings[0]->phone_number; ?> - <?php echo $system_global_settings[0]->mobile_number; ?> </strong></small>
                                        
                                    </td>
                                    
                                </tr>

                            </table>

                            <hr style="margin: 2px;" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                <td>
                    <div >
                    <h4 style="text-align:center"><strong>Training Schedule</strong></h4>
                    
                    <h5>Training: <strong><?php 
                    echo $training->title ?> - Code: <?php echo $training->code ?></strong></h5>
                    <h6>Batch: <strong><?php 
                    echo $batch->batch_title ?> - Date : <?php echo date('d M, Y', strtotime($batch->batch_start_date)) ?> to 
                    <?php echo date('d M, Y', strtotime($batch->batch_end_date)) ?> - location: (<?php echo  $batch->location; ?>) </strong></h6>
                    
                    <hr style="margin-bottom: 10px;" />
                </div>

                    <?php
        $startDate = new DateTime($batch->batch_start_date);
        $endDate = new DateTime($batch->batch_end_date);

        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {

        ?>
            <table class="table table-striped" style=" width: 100%; border-collapse: separate; border-spacing: 2px; margin-bottom:10px; border:1px solid lightgray; border-radius:5px;">
                
            <tr>

                    <td colspan="5">
                        <strong><?php echo date('l j F Y', strtotime($currentDate->format('Y-m-d'))); ?></strong>
                        <hr style="margin: 2px !important;" />
                    </td>
                </tr>
                <?php
                $query = "SELECT * FROM `training_batch_sessions` 
                                            WHERE training_id = '" . $training->training_id . "' 
                                            AND batch_id = '" . $batch->batch_id . "'
                                            AND session_date = '" . $currentDate->format('Y-m-d') . "'
                                            ORDER BY start_time ASC";
                $batch_sessions = $this->db->query($query)->result();
                foreach ($batch_sessions as $batch_session) {
                ?>
                    <tr >
                   
                        <th style="border-left: 2px solid gray; width:150px !important">
                            <?php echo strtoupper(date('g:i a', strtotime($batch_session->start_time))); ?>
                            -
                            <?php echo strtoupper(date('g:i a', strtotime($batch_session->end_time))); ?>
                        </th>
                        <td >
                            <?php if ($batch_session->activity_type = 'Activity') { ?>
                                <?php echo $batch_session->course_title; ?>
                            <?php } ?>
                            <?php if ($batch_session->activity_type = 'Break') { ?>
                                <strong><?php echo $batch_session->break_detail; ?></strong>
                            <?php } ?>
                        </td>
                        <th style="width:100px !important"><?php if ($batch_session->facilitator_id) {
                                $query = "SELECT * FROM users WHERE user_id = $batch_session->facilitator_id";
                                $facilitator = $this->db->query($query)->row();
                                if ($facilitator) {
                                    echo $facilitator->name . " <br />(<small><i>" . $facilitator->designation . "</i></small>)";
                                }
                            } ?></th>
                        
                    </tr>
                <?php } ?>
                        </td>
                        </tr>
            </table>
            

        <?php

            $currentDate->modify('+1 day');
        }
        ?>



                      

                    </td>

                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <p style="text-align: center;">
                                <small>
                                    <strong><?php echo $system_global_settings[0]->address ?></strong>

                                    <br />
                                    Print @ <?php echo date("d M, Y h:m:s A"); ?>
                                    by
                                    <?php
                                    $query = "SELECT
                                `roles`.`role_title`,
                                `users`.`name`  
                                FROM `roles`,
                                `users` 
                                WHERE `roles`.`role_id` = `users`.`role_id`
                                AND `users`.`user_id`='" . $this->session->userdata("userId") . "'";
                                    $user_data = $this->db->query($query)->row();

                                    ?>
                                    <?php echo $user_data->name; ?> (<?php echo $user_data->role_title; ?>)
                                </small>
                            </p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </page>
</body>



</html>