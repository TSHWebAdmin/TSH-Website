<?php
get_header();
?>
<div class="theme_page relative">
	<div class="page_layout page_margin_top clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1 class="page_title"><?php the_title(); ?></h1>
				    <ul class="bread_crumb">
        				<li>
            					<div class="breadcrumbs">
   						<?php if(function_exists('bcn_display'))
 						   {
     							  bcn_display();
  						    }?>
						</div>
       					 </li>
    				</ul>
			</div>
			<?php
			$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_header", true));
			if(!(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name)):
			?>
			<div class="page_header_right">
				<?php
				dynamic_sidebar($sidebar->post_name);
				?>
			</div>
			<?php
			endif;
			?>
		</div>
		<div class="clearfix">
			<?php
			if(have_posts()) : while (have_posts()) : the_post();
				the_content();
			endwhile; endif;
			?>
		</div>
	</div>
</div>
<?php
get_footer(); 
?>