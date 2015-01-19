<?php
//contact form
function theme_contact_form_shortcode($atts)
{
	extract(shortcode_atts(array(
		"id" => "map",
		"header" => __("Online Appointment Form ", 'medicenter'),
		"department_select_box" => 1,
		"height" => "300px",
		"map_type" => "ROADMAP",
		"lat" => "-37.732304",
		"lng" => "144.868641",
		"marker_lat" => "-37.732304",
		"marker_lng" => "144.868641",
		"zoom" => "12",
		"streetviewcontrol" => "false",
		"maptypecontrol" => "false",
		"icon_url" => get_template_directory_uri() . "/images/map_pointer.png",
		"icon_width" => 38,
		"icon_height" => 45,
		"icon_anchor_x" => 18,
		"icon_anchor_y" => 44,
		"top_margin" => "page_margin_top"
	), $atts));
	
	$output = "";
	if($header!="")
		$output .= '<h3 class="box_header' . ($top_margin!="none" ? ' ' . $top_margin : '') . '">' . $header . '</h3>';
	$output .= '<form class="contact_form ' . ($top_margin!="none" && $header!="" ? $top_margin : 'page_margin_top') . '" id="' . $id . '" method="post" 

action="">';
	if((int)$department_select_box)
	{
		//get departments list
		$departments_list = get_posts(array(
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'post_type' => 'departments'
		));
		if(count($departments_list))
		{
			$output .= '<ul class="clearfix tabs_box_navigation sf-menu">
				<li class="tabs_box_navigation_selected wide">
					<input type="hidden" name="department" value="" />
					<span>' . __("Select department", 'medicenter') . '</span>
					<ul class="sub-menu">';
			foreach($departments_list as $department)
				$output .= '<li><a href="#' . urldecode($department->post_name) . '" title="' . esc_attr($department->post_title) . '">' . 

$department->post_title . '</a></li>';
			$output .= '</ul>
				</ul>';
		}
	}
	$output .= '<fieldset class="left">
		<label>' . __("Your Name", 'medicenter') . '</label>
			<div class="block">
				<input class="text_input" name="your_name" type="text" value="" />
			</div>
            
        <label>' . __("E-mail", 'medicenter') . '</label>
			<div class="block">
				<input class="text_input" type="text" name="email" value="" />
			</div>


	<label>' . __("Would you like to have someone from The Scarborough Hospital follow up with you?", 'medicenter') . '</label>
			<div class="block clearfix tabs_box_navigation sf-menu">
                <select class="tabs_box_navigation_selected wide" name="follow_up">
                  <option value="">Select</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
			</div>


		<label>' . __("What type of comment would you like to send?", 'medicenter') . '</label>
			<div class="block clearfix tabs_box_navigation sf-menu">
                <select class="tabs_box_navigation_selected wide" name="comment_type">
                  <option value="">Select</option>
                  <option value="compliment">Compliment</option>
                  <option value="complaint">Complaint</option>
                  <option value="suggestion">Suggestion</option>
                </select>
			</div>

		<label>' . __("Please indicate whether you are a:", 'medicenter') . '</label>
			<div class="block clearfix tabs_box_navigation sf-menu">
                <select class="tabs_box_navigation_selected wide" name="you_are_a">
                  <option value="">Select</option>
                  <option value="compliment">Patient</option>
                  <option value="complaint">Family Member Of A Patient</option>
                  <option value="suggestion">Hospital Visitor</option>
                </select>
			</div>
			
        <label>' . __("At which campus of TSH did you receive treatment?", 'medicenter') . '</label>
			<div class="block clearfix tabs_box_navigation sf-menu">
                <select class="tabs_box_navigation_selected wide" name="campus">
                  <option value="">Select</option>
                  <option value="birchmount">Birchmount</option>
                  <option value="general">General</option>
                  <option value="unsure">Not Sure/Cannot Recall</option>
                </select>
			</div>

            
		<label>' . __("In which department of the hospital did you receive treatment? (for example. Emergency, Birthing, Surgery, Dialysis, etc.)", 

'medicenter') . '</label>
			<div class="block">
                		<input class="text_input" type="text" name="treatment" value="" />
			</div>

			
        <label>' . __("Date you entered the hospital? (dd/mm/yyyy)", 'medicenter') . '</label>
			<div class="block">
                		<input class="text_input" type="text" name="entered" value="" />
			</div>

	<label>' . __("Date discharged from the hospital? (dd/mm/yyyy)", 'medicenter') . '</label>
			<div class="block">
                		<input class="text_input" type="text" name="discharged" value="" />
			</div>
			
		</fieldset>
        
		<fieldset style="clear:both;">
			<label>' . __("Please write any additional comments or suggestions. We welcome all feedback.", 'medicenter') . '</label>
			<div class="block">
				<textarea name="message"></textarea>
			</div>
			<input type="hidden" name="action" value="theme_contact_form" />
			<input type="submit" name="submit" value="' . __("Send", 'medicenter') . '" class="more mc_button" />
		</fieldset>
	</form>';
	return $output;
}
add_shortcode($themename . "_contact_form", "theme_contact_form_shortcode");

//visual composer
function theme_contact_form_vc_init()
{
	wpb_map( array(
		"name" => __("Contact form", 'medicenter'),
		"base" => "medicenter_contact_form",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-contact-form",
		"category" => __('MediCenter', 'medicenter'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'medicenter'),
				"param_name" => "id",
				"value" => "contact_form",
				"description" => __("Please provide unique id for each contact form on the same page/post", 'medicenter')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Header", 'medicenter'),
				"param_name" => "header",
				"value" => __("Online Appointment Form ", 'medicenter')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Display department select box", 'medicenter'),
				"param_name" => "department_select_box",
				"value" => array(__("yes", 'medicenter') => 1, __("no", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'medicenter'),
				"param_name" => "top_margin",
				"value" => array(__("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => 

"page_margin_top_section",  __("None", 'medicenter') => "none")
			)
		)
	));
}
add_action("init", "theme_contact_form_vc_init");

//contact form submit
function theme_contact_form()
{
	global $theme_options;

    require_once("phpMailer/class.phpmailer.php");

    $result = array();
	$result["isOk"] = true;
	if($_POST["your_name"]!="" && $_POST["email"]!="" && preg_match("#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$#", $_POST

["email"]) && $_POST["message"]!="")
	{
		$values = array(
			"department" => $_POST["department"],
			"your_name" => $_POST["your_name"],
			"email" => $_POST["email"],
			"follow_up" => $_POST["follow_up"],
			"comment_type" => $_POST["comment_type"],
			"you_are_a" => $_POST["you_are_a"],
			"campus" => $_POST["campus"],
			"treatment" => $_POST["treatment"],
			"entered" => $_POST["entered"],
			"discharged" => $_POST["discharged"],
			"message" => $_POST["message"]
		);
		if((bool)ini_get("magic_quotes_gpc")) 
			$values = array_map("stripslashes", $values);
		$values = array_map("htmlspecialchars", $values);

		$mail=new PHPMailer();

		$mail->CharSet='UTF-8';

		$mail->SetFrom($values["email"], $values["name"]);
		$mail->AddAddress($theme_options["cf_admin_email"], $theme_options["cf_admin_name"]);

		$smtp = $theme_options["cf_smtp_host"];
		if(!empty($smtp))
		{
			$mail->IsSMTP();
			$mail->SMTPAuth = true; 
			$mail->Host = $theme_options["cf_smtp_host"];
			$mail->Username = $theme_options["cf_smtp_username"];
			$mail->Password = $theme_options["cf_smtp_password"];
			if((int)$theme_options["cf_smtp_post"]>0)
				$mail->Port = (int)$theme_options["cf_smtp_port"];
			$mail->SMTPSecure = $theme_options["cf_smtp_secure"];
		}
		
		$subject = $theme_options["cf_email_subject"];
		$subject = str_replace("[department]", $values["department"], $subject);
		$subject = str_replace("[your_name]", $values["your_name"], $subject);
		$subject = str_replace("[follow_up]", $values["follow_up"], $subject);
		$subject = str_replace("[date]", $values["comment_type"], $subject); 
		$subject = str_replace("[you_are_a]", $values["you_are_a"], $subject); 
		$subject = str_replace("[entered]", $values["entered"], $subject);
		$subject = str_replace("[campus]", $values["campus"], $subject);
		$subject = str_replace("[discharged]", $values["discharged"], $subject);
		$subject = str_replace("[treatment]", $values["treatment"], $subject);
		$subject = str_replace("[email]", $values["email"], $subject);
		$subject = str_replace("[message]", $values["message"], $subject);
		$mail->Subject = $subject;
		$body = $theme_options["cf_template"];
		$body = str_replace("[department]", $values["department"], $body);
		$body = str_replace("[your_name]", $values["your_name"], $body);
		$body = str_replace("[follow_up]", $values["follow_up"], $body);
		$body = str_replace("[date]", $values["comment_type"], $body); 
		$body = str_replace("[you_are_a]", $values["you_are_a"], $body); 
		$body = str_replace("[entered]", $values["entered"], $body);
		$body = str_replace("[campus]", $values["campus"], $body);
		$body = str_replace("[discharged]", $values["discharged"], $body);
		$body = str_replace("[treatment]", $values["treatment"], $body);
		$body = str_replace("[email]", $values["email"], $body);
		$body = str_replace("[message]", $values["message"], $body);
		$mail->MsgHTML($body);

		if($mail->Send())
			$result["submit_message"] = __("Thank you for contact us", 'medicenter');
		else
		{
			$result["isOk"] = false;
			$result["submit_message"] = __("Sorry, we can't send this message", 'medicenter');
		}
	}
	else
	{
		$result["isOk"] = false;
		if($_POST["your_name"]=="")
			$result["error_your_name"] = __("Please enter your name.", 'medicenter');
		if($_POST["email"]=="" || $_POST["email"]==_def_email || !preg_match("#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]

{2,4})$#", $_POST["email"]))
			$result["error_email"] = __("Please enter valid e-mail.", 'medicenter');
		if($_POST["message"]=="" || $_POST["message"]==_def_message)
			$result["error_message"] = __("Please enter your message.", 'medicenter');
	}
	echo @json_encode($result);
	exit();
}
add_action("wp_ajax_theme_contact_form", "theme_contact_form");
add_action("wp_ajax_nopriv_theme_contact_form", "theme_contact_form");
?>