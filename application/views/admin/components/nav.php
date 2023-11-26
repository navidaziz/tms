<?php




$menu_list = "<ul>";
foreach ($menu_arr as $controller_id => $controller_data) {

    $cn_class = "";
    if ($controller_name == $controller_data['controller_uri']) {
        $cn_class = "active";
    }

    if ($controller_data['actions']) {

        $menu_list .= "<li class='has-sub " . $cn_class . "'>
				<a href='javascript:;' class=''>
				<i style=\"color:#000\" class='fa " . $controller_data['controller_icon'] . " fa-fw'></i> <span class='menu-text' style=\"color:#000\">" . $controller_data['controller_title'] . "</span>
				<span class='arrow'></span>
				</a>";


        //create sub menu
        $menu_list .= "<ul class='sub'>";
        //check of we have any action for this controller
        if (isset($controller_data['actions']) and is_array($controller_data['actions'])) {

            foreach ($controller_data['actions'] as $action) {

                $class = "";
                if ($current_action_id == $action['action_id']) {
                    $class = "current";
                }
                $menu_list .= "<li class='" . $class . "' ><a class='' href='" . site_url(ADMIN_DIR . $controller_data['controller_uri'] . "/" . $action['action_uri']) . "'><span class='sub-menu-text' style=\"color:#000\">" . $action['action_title'] . "</span></a></li>";
            }
        }

        $menu_list .= "</ul>";
        //end of sub menu

        $menu_list .= "</li>";
    } else {
        if (isset($controller_data['actions']) and is_array($controller_data['actions'])) {

            foreach ($controller_data['actions'] as $action) {

                $class = "";
                if ($current_action_id == $action['action_id']) {
                    $class = "current";
                }



                $menu_list .= "<li class='has-sub " . $cn_class . "'>
				<a href='" . site_url(ADMIN_DIR . $controller_data['controller_uri'] . "/" . $action['action_uri']) . "' class=''>
				<i style=\"color:#000\" class='fa " . $controller_data['controller_icon'] . " fa-fw'></i> <span class='menu-text' style=\"color:#000\">" . $controller_data['controller_title'] . "</span>
				<!--<span class='arrow'></span>-->
				</a></li>";
            }
        }
    }
}
$menu_list .= "</ul>";


?>
<!-- SIDEBAR -->




<div id="sidebar" <?php if ($this->router->fetch_class() == 'orders' or $this->router->fetch_class() == 'riders') { ?> class="sidebar mini-menu" <?php } else { ?>class="sidebar" <?php } ?>>

    <?php if ($this->session->userdata('role_id') == 14) {

        $query = "SELECT
    `groups`.`group_name`
	,`groups`.`group_id`
    , `groups`.`group_code`
    , `group_gender_types`.`group_gender_type_title`
    , `group_types`.`group_type_title`
FROM
`group_gender_types`
,`groups` 
,`group_types`
WHERE `group_gender_types`.`group_gender_type_id` = `groups`.`group_gender_type_id`
AND `group_types`.`group_type_id` = `groups`.`group_type_id`
AND  `groups`.`group_id` = " . $this->session->userdata('group_id');
        $current_group_query = $this->db->query($query); ?>
        <!--<span style="text-align:center; color:#000000 !important;">	
			<h5><?php
                echo $current_group_query->result()[0]->group_name . " (" . $current_group_query->result()[0]->group_gender_type_title . ")<br />";
                ?></h5>
				<h6><strong><?php echo $current_group_query->result()[0]->group_code . "</strong><br />";
                            echo $current_group_query->result()[0]->group_type_title . "<br />";
                            ?></h6>
                </span>-->

    <?php  } ?>




    <div class="sidebar-menu nav-collapse">

        <h4 style="text-align:center; color:red">Beta Version</h4>



        <!--<div class="divide-20"></div>-->
        <!-- SEARCH BAR -->
        <!--<div id="search-bar">
        <form action="<?php echo base_url(ADMIN_DIR . "complaints/search"); ?>" method="post">
			<input class="search" type="text"  name="complaint_code" placeholder="Complaint Code"
			<?php //if($this->router->fetch_class()=='dashboard'){ 
            ?>  <?php //}else{ 
                                                                        ?>  <?php //} 
                                                                                            ?> >
            <button type="submit" class="fa fa-search search-icon" style="background:none !important; border:none !important;"></button>
            </form>
		</div>-->
        <!-- /SEARCH BAR -->

        <!-- SIDEBAR QUICK-LAUNCH -->
        <!-- <div id="quicklaunch">
		<!-- /SIDEBAR QUICK-LAUNCH -->

        <!-- SIDEBAR MENU -->
        <?php echo $menu_list; ?>
        <!-- /SIDEBAR MENU -->
    </div>
</div>
<!-- /SIDEBAR -->