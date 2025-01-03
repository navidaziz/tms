<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->
            <?php
            $query = "SELECT trainings.*
                FROM `training_nominations`
                INNER JOIN trainings ON(trainings.training_id = training_nominations.training_id) 
                WHERE training_nominations.training_id = '" . $training_id . "'
                AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'";
            $training = $this->db->query($query)->row();
            ?>
            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . $this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "trainee"); ?>">Dashboard (Training List)</a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "trainee/training_detail/" . $training_id . "/" . $batch_id); ?>">#<?php echo $training->code; ?> </a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <div class="clearfix">
                        <h4><?php echo $title; ?></h4>
                        <h5 class="content-ti tle">
                            <?php
                            $query = "SELECT trainings.*
            FROM `training_nominations`
            INNER JOIN trainings ON(trainings.training_id = training_nominations.training_id) 
            WHERE training_nominations.training_id = '" . $training_id . "'
            AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'";
                            $training = $this->db->query($query)->row();
                            ?>
                            <?php echo $training->title ?>

                        </h5>
                        <?php
                        $query = "SELECT training_batches.*
                FROM `training_nominations`
                INNER JOIN training_batches ON(training_batches.batch_id = training_nominations.batch_id)
                WHERE training_nominations.batch_id = '" . $batch_id . "'
                AND training_nominations.training_id = '" . $training->training_id . "'
                AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'";
                        $batch = $this->db->query($query)->row();
                        ?>
                        <h5>T-Code: <?php echo $training->code; ?> : <?php echo $batch->batch_title; ?></h5>


                    </div>
                </div>


            </div>


        </div>
    </div>
</div>

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->

    <div class="col-md-12">
        <div class="table-responsive">

            <div class="box border blue" id="messenger">

                <div class="box-body">

                    <?php

                    $trainee_id = $this->session->userdata('userId');
                    $query = "SELECT *  FROM training_tests
                    WHERE training_id = " . $training_id . "
                    AND batch_id = " . $batch_id . "
                    AND trainee_id = " . $trainee_id . "";
                    if ($test_type == "pre_test") {
                        $query .= " AND pre_test_result  IS NULL";
                        $testType = "Pre Test";
                    }
                    if ($test_type == "post_test") {
                        $query .= " AND post_test_result  IS NULL";
                        $testType = "Post Test";
                    }
                    $query .= " LIMIT 1";
                    $question = $this->db->query($query)->row();

                    if ($question) {
                    ?>

                        <?php
                        $query = "SELECT COUNT(*) as total, ";
                        if ($test_type == "pre_test") {
                            $query .= " SUM(IF(pre_test_result IS NOT NULL,1,0)) as attempt ";
                        }

                        if ($test_type == "post_test") {
                            $query .= " SUM(IF(post_test_result IS NOT NULL,1,0)) as attempt ";
                        }
                        $query .= " FROM training_tests
                                            WHERE training_id = " . $training_id . "
                                            AND batch_id = " . $batch_id . "
                                            AND trainee_id = " . $trainee_id . "";
                        $question_info = $this->db->query($query)->row();


                        ?>
                        <p style="text-align: right;">
                            <strong><?php echo $question_info->attempt + 1; ?> / <?php echo $question_info->total; ?>
                            </strong>
                        </p>
                        <h3>Question: <?php echo $question->question; ?></h3>
                        <form onsubmit="return confirm('Do you really want to submit the answer?');" action="<?php echo site_url(ADMIN_DIR . "trainee/question_answer"); ?>" method="post">
                            <input type="hidden" name="training_id" value="<?php echo $training_id; ?>" />
                            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>" />
                            <input type="hidden" name="mcq_id" value="<?php echo $question->mcq_id; ?>" />
                            <input type="hidden" name="test_type" value="<?php echo $test_type; ?>" />
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-sm-6" style="cursor:pointer" onclick="check_answer('<?php echo $question->a; ?>')">
                                    <small class="list-group-item" style="margin:2px; border-left: 40px solid hsl(27deg 91% 55%);" id="<?php echo $question->a; ?>">


                                        <span style="margin-left: -45px; position: absolute; font-size: 25px; margin-top: -10px;  color:white;">A.</span>
                                        <span style="font-size: 20px;"> <?php echo $question->a; ?> </span>
                                        <span class="pull-right"><input required type="radio" name="answer" value="<?php echo $question->a; ?>" /></span>
                                    </small>
                                </div>
                                <div class="col-sm-6" style="cursor:pointer" onclick="check_answer('<?php echo $question->b; ?>')">
                                    <small class="list-group-item" style="margin:2px; border-left: 40px solid hsl(27deg 91% 55%);" id="<?php echo $question->b; ?>">
                                        <span style="margin-left: -45px; position: absolute; font-size: 25px; margin-top: -10px;  color:white;">B.</span>
                                        <span style="font-size: 20px;"> <?php echo $question->b; ?> </span>
                                        <span class="pull-right"><input required type="radio" name="answer" value="<?php echo $question->b; ?>" /></span>
                                    </small>
                                </div>
                                <div class="col-sm-6" style="cursor:pointer" onclick="check_answer('<?php echo $question->c; ?>')">
                                    <small class="list-group-item" style="margin:2px; border-left: 40px solid hsl(27deg 91% 55%);" id="<?php echo $question->c; ?>">
                                        <span style="margin-left: -45px; position: absolute; font-size: 25px; margin-top: -10px;  color:white;">C.</span>
                                        <span style="font-size: 20px;"> <?php echo $question->c; ?> </span>
                                        <span class="pull-right"><input required type="radio" name="answer" value="<?php echo $question->c; ?>" /></span>
                                    </small>
                                </div>
                                <div class="col-sm-6" style="cursor:pointer" onclick="check_answer('<?php echo $question->d; ?>')">
                                    <small class="list-group-item" style="margin:2px; border-left: 40px solid hsl(27deg 91% 55%) " id="<?php echo $question->d; ?>">
                                        <span style="margin-left: -45px; position: absolute; font-size: 25px; margin-top: -10px; color:white;">D.</span>
                                        <span style="font-size: 20px;"> <?php echo $question->d; ?> </span>
                                        <span class="pull-right"><input required type="radio" name="answer" value="<?php echo $question->d; ?>" /></span>
                                    </small>
                                </div>
                            </div>
                            <div style="text-align: center; margin-top:10px">
                                <button class="btn btn-primary ">
                                    <h4><i class="fa fa-check-square-o" aria-hidden="true"></i> Submit Answer</h4>
                                </button>
                            </div>
                        </form>

                    <?php
                    } else { ?>
                        <div style="text-align: center !important;">
                            <h3>
                                <?php echo $testType; ?> Completed</h3>
                            <hr />
                            <h5><?php echo $testType; ?> Result Summary</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Total Question</th>
                                        <th>Wrong Answers</th>
                                        <th>Correct Answers</th>
                                        <th>Percentage (%)</th>
                                    </tr>
                                    <?php
                                    $query = "SELECT COUNT(*) as total, ";
                                    if ($test_type == "pre_test") {
                                        $query .= " SUM(IF(pre_test_result=1,1,0)) as correct_ans,
                                        SUM(IF(pre_test_result=0,1,0)) as wrong_ans ";
                                    }

                                    if ($test_type == "post_test") {
                                        $query .= " SUM(IF(post_test_result=1,1,0)) as correct_ans,
                                        SUM(IF(post_test_result=0,1,0)) as wrong_ans ";
                                    }
                                    $query .= " FROM training_tests
                                            WHERE training_id = " . $training_id . "
                                            AND batch_id = " . $batch_id . "
                                            AND trainee_id = " . $trainee_id . "";
                                    $summary = $this->db->query($query)->row();


                                    ?>
                                    <tr>
                                        <td><?php echo $summary->total; ?></td>
                                        <td><?php echo $summary->wrong_ans; ?></td>
                                        <td><?php echo $summary->correct_ans; ?></td>
                                        <td><?php echo round(($summary->correct_ans * 100) / $summary->total, 2) . " %"; ?></td>
                                    </tr>
                                </table>

                        </div>
                    <?php } ?>
                    <script>
                        function check_answer(answer) {
                            correct_answer = '<?php echo $question->answer; ?>';
                            mcq_id = '<?php echo $question->id; ?>';
                            user_answar = answer;
                            if (correct_answer === user_answar) {
                                document.getElementById(user_answar).style.backgroundColor = "#90ee90";
                                document.getElementById("answer_detail").style.display = "block";
                                var snd = new Audio("data:audio/mpeg;base64,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wZ0G7jqlt/OcDIKX+/1NblSX+VKfQfP8xuJJGk7////rf////+PgXTv///1JThJJQainmySAB6imUyuVbVttUo7T4Csa821OuF88f62+CZHFnGf///mQgYIEO0SMF2NVy9NxYTdlqJ8AuS4zr//SJoTUJ+CaKKTcZvosrUPo8W/MUv0f033E9E/QpN6P///v/////WRR2mwUAYUABjabRu1vrOLKAF0kIdHjnEx/iNWo7jGn1////mApxNTJQQOU1Het/NoUFTMQs6Vja///THaGIl/0fojl8mjd/Jo8W+ZfpNpCajsz7////6kn/////WRRgDz//LD1KSTDjKOciSAKxdLx5S31uYqKIWj/+5JECgAC8V5M6g9rdFyr6Vo9rW6KtHcr5DEJQRkSpLRklSigvVc4QpmyPe9H3zHR1/in9P/8VNCMJOzYUDyVjfwHP0ZgiZt/3/+9EBnDKbegdUrckhgntHaQ9vX/X/9A/////+r/////mJ3/9ItRcoVRogAcmV9N8z0pvES8QQsKoMGXEymPQyWm6E4HQLqgpv/CZJAtYXQSwoF8e6SB56zABEoW+qgZjJAZovGr0Gl5/OjFKL3JwnaX9v7/X8y1f/////////49WAzMzEYYMZLq6CUANIqbDX7lisBIdraAEPwShTRc9WZ2vAqBc4NQ9GrUNaw0Czcrte0g1NEoiU8NFjx4NFh54FSwlOlgaCp0S3hqo8SLOh3/63f7P/KgKJxxhgGSnAFMCnIogwU5JoqBIDAuBIiNLETyFmiImtYiDTSlb8ziIFYSFv/QPC38zyxEOuPeVGHQ77r/1u/+kq49//6g4gjoVQSUMYQUSAP8PwRcZIyh2kCI2OwkZICZmaZxgnsNY8DmSCWX0idhtz3VTJSqErTSB//1X7TTTVVV//uSZB2P8xwRJ4HvYcItQlWBACM4AAABpAAAACAAADSAAAAEVf/+qCE000VVVVU0002//+qqqqummmmr///qqqppppoqqqqppppoqqATkEjIyIxBlBA5KwUEDBBwkFhYWFhUVFfiqhYWFhcVFRUVFv/Ff/xUVFRYWFpMQU1FMy45OS41qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqg==");
                                snd.play();
                                $.ajax({
                                    type: "POST",
                                    url: '<?php echo site_url(ADMIN_DIR . "home/add_user_mcqs"); ?>',
                                    data: {
                                        mcq_id: mcq_id,
                                        correct: 1
                                    }
                                }).done(function(data) {

                                    $('#correct_answer').show();
                                    $('#next_button').html('<button class="btn btn-warning" onclick="location.reload();">Next Quesiton</button>');
                                    //alert(data);
                                });


                            } else {
                                document.getElementById(user_answar).style.backgroundColor = "#ffcccb";
                                document.getElementById("answer_detail").style.display = "block";
                                var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");
                                snd.play();
                                $.ajax({
                                    type: "POST",
                                    url: '<?php echo site_url(ADMIN_DIR . "home/add_user_mcqs"); ?>',
                                    data: {
                                        mcq_id: mcq_id,
                                        correct: 0
                                    }
                                }).done(function(data) {
                                    //location.reload();
                                    //$('#mcq').html(data);
                                    //alert(data);
                                });

                            }
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>