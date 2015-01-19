<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<?php global $theme_options; ?>

	<head>

		<title><?=$_SITE['title'];?> - Current Opportunities: <!--WSTM_TITLE--></title>

		<!--meta-->

		<meta charset="<?php bloginfo("charset"); ?>" />

		<meta name="generator" content="WordPress <?php bloginfo("version"); ?>" />

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<meta name="description" content="<?php bloginfo('description'); ?>" />

		<meta name="format-detection" content="telephone=no" />

		<!--style-->

		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo("rss2_url"); ?>" />

		<link rel="pingback" href="<?php bloginfo("pingback_url"); ?>" />

		<!--<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />-->

		<?php

		wp_head();

		?>

	</head>

	<body <?php body_class(); ?>>

		<div class="site_container<?php echo ($theme_options['layout']=="boxed" || (isset($_COOKIE['mc_layout']) && $_COOKIE['mc_layout']=="boxed") ? ' boxed' : ''); ?>">

			<!-- Header -->

			<div class="header_container">

				<div class="header clearfix">

					<?php

					if(is_active_sidebar('header-top')):

					?>

					<div class="header_top_sidebar clearfix">

					<?php

					get_sidebar('header-top');

					?>

					</div>

					<?php

					endif;

					?>

					<div class="header_left">

						<a href="<?php echo get_home_url(); ?>" title="<?php bloginfo("name"); ?>">

							<?php if($theme_options["logo_url"]!=""): ?>

							<img src="<?php echo $theme_options["logo_url"]; ?>" alt="logo" />

							<?php endif; ?>

							<?php if($theme_options["logo_text"]!=""): ?>

							<span class="logo"><?php echo $theme_options["logo_text"]; ?></span>

							<?php 

							endif;

							?>

						</a>

					</div>

					<?php 

					//Get menu object

					$locations = get_nav_menu_locations();

					$main_menu_object = get_term($locations["main-menu"], "nav_menu");

					if(has_nav_menu("main-menu") && $main_menu_object->count>0) 

					{

						wp_nav_menu(array(

							"theme_location" => "main-menu",

							"menu_class" => "sf-menu header_right"

						));

						wp_nav_menu(array(

							'container_class' => 'mobile_menu',

							'theme_location' => 'main-menu', // your theme location here

							'walker'         => new Walker_Nav_Menu_Dropdown(),

							'items_wrap'     => '<select>%3$s</select>',

						));

						/*

						<select>

							<option value="-">-</option>

							<?php

							$menu_items = wp_get_nav_menu_items($main_menu_object->term_id);

							print_r($menu_items);

							foreach((array)$menu_items as $key => $menu_item ) 

							{

								?>

								<option value="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></option>

								<?php

							}

							echo count($menu_items);

							?>

						</select>*/

					}

					?>

				</div>

			</div>

		<!-- /Header -->

<table style="width:1090px;">


<tr valign="top">
	<td style="width:1090px; padding:20px 50px">
						<!-- Workstream breadcrumb -->
						<a href='http://tsh.to/'>Home</a> &gt; <!--WSTM_BC_START--> <a href="WSTM_HREF">WSTM_TITLE</a> <!-- WSTM_BC_LAST--> &gt; WSTM_TITLE <!--WSTM_BC_END-->
						<!-- breadcrumb -->
   </td></tr>
                </table>
                <table style="width:1090px;">   
                    
					
                    <tr valign="top">
                    <td class="PressRelease" style="width:220px; padding:10px 20px 10px 50px">
						<?
						
						echo ($back ? "<div><a href='/'>Home</a></div>  <!-- Everything before the dynamic part of the nav is left untouched -->" : "");

							echo "<!--WSTM_MenuSelStart-->";
							echo "<div><a href='WSTM_HRef'>WSTM_Title</a></div>";
							echo "<!--WSTM_MenuSelEnd-->";
							echo "<!--WSTM_MenuUnselStart-->";
							echo "<div><a href='WSTM_HRef'>WSTM_Title</a></div>";
							echo "<!--WSTM_MenuUnselEnd-->";

						?>
						</td>
	
					<!-- sidebar -->
				<td style="width:920px; padding:10px 50px 10px 0px">
                <!-- workstream Body -->
				<!--WSTM_BODY-->
                </td>
                </tr>
                </table>



	<div style="padding:15px 0">

	</div>



<?php

get_footer(); 

?>