<?php
/**
 * Header template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<!DOCTYPE html>
<html class="<?php avada_the_html_class(); ?>" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php Avada()->head->the_viewport(); ?>

	<?php wp_head(); ?>

	<?php
	/**
	 * The setting below is not sanitized.
	 * In order to be able to take advantage of this,
	 * a user would have to gain access to the database
	 * in which case this is the least of your worries.
	 */
	echo apply_filters( 'avada_space_head', Avada()->settings->get( 'space_head' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	//gravity_form_enqueue_scripts(1,true);
	?>
	<script src="<?php echo get_theme_file_uri( '/js/preloader.js' );?>"></script>
	<script>
	var $=jQuery;
		
	$(document).ready(function () {
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
      {
      }else{
        $("body").queryLoader2({
          barColor: "#0072bc",
          backgroundColor: "#000",
          percentage: true,
          barHeight: 2,
          completeAnimation: "grow"
        });
        
      } 
    });
//     document.onreadystatechange = function() {
//   if (document.readyState !== "complete") { 
//     document.querySelector("#boxed-wrapper").style.visibility = "hidden"; 
//     //document.querySelector("#loader").style.visibility = "visible"; 
//   } else { 
//     //document.querySelector("#loader").style.display = "none"; 
//     document.querySelector("#boxed-wrapper").style.visibility = "visible"; 
//   } 
// };

	</script>
</head>

<?php
$object_id      = get_queried_object_id();
$c_page_id      = Avada()->fusion_library->get_page_id();
$wrapper_class  = 'fusion-wrapper';
$wrapper_class .= ( is_page_template( 'blank.php' ) ) ? ' wrapper_blank' : '';
$menu_1=get_field('menu_1', 'option');
$menu_2=get_field('menu_2', 'option');
$menu_3=get_field('menu_3', 'option');
$menu_4=get_field('menu_4', 'option');
?>
<body <?php body_class(); ?> <?php fusion_element_attributes( 'body' ); ?>>
	
	<?php do_action( 'avada_before_body_content' ); ?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'Avada' ); ?></a>
	<div class="sitemenu is-hidden">
	    <span class="i1" style="background: url(<?php echo $menu_1['bg_image'];?>) no-repeat center center;"></span> 
	    <span class="i2" style="background: url(<?php echo $menu_2['bg_image'];?>) no-repeat center center;"></span>
	    <span class="i3" style="background: url(<?php echo $menu_3['bg_image'];?>) no-repeat center center;"></span>
	    <span class="i4" style="background: url(<?php echo $menu_4['bg_image'];?>) no-repeat center center;"></span>
	    <div class="main-navigation-list-wrapper mn1">
	        <div class="main-navigation-list">
	        	<?php foreach ($menu_1['menu'] as $menu) :
	        		echo '<span class="title"><a href="'.$menu['link']['url'].'">'.$menu['link']['title'].'</a></span><br />';
	        	endforeach;
	        	?>
	            
	            <span class="sec-nav rv-mv-logos">
	                <?php if(is_page(array(297))):
	                	echo '<a href="https://www.revgroup.com/rev-new-ambulance-interior" target="_blank"><img src="'.site_url().'/wp-content/uploads/2021/01/flex-logo.png" alt=""></a>';
	                endif;?>
	                <a href="https://www.revgroup.com/rev-ambulance-zero-rpm-idle-control-system" target="_blank"><img src="<?php echo $menu_1['logo'];?>" alt="" /></a>
	            </span>
	        </div>
	    </div>
	    <div class="main-navigation-list-wrapper mn2">
	        <div class="main-navigation-list">
	            <?php foreach ($menu_2['menu'] as $menu) :
	        		echo '<span class="title"><a href="'.$menu['link']['url'].'">'.$menu['link']['title'].'</a></span><br />';
	        	endforeach;
	        	?>
	        </div>
	    </div>
	    <div class="main-navigation-list-wrapper mn3">
	        <div class="main-navigation-list">
	            <?php foreach ($menu_3['menu'] as $menu) :
	        		echo '<span class="title"><a href="'.$menu['link']['url'].'">'.$menu['link']['title'].'</a></span><br />';
	        	endforeach;
	        	?>
	        </div>
	    </div>
	    <div class="main-navigation-list-wrapper mn4">
	        <div class="main-navigation-list">
	            <?php foreach ($menu_4['menu'] as $menu) :
	        		echo '<span class="title"><a href="'.$menu['link']['url'].'" class="'.$menu['class'].'">'.$menu['link']['title'].'</a></span><br />';
	        	endforeach;
	        	?>
	            <span class="sec-nav">
	                <a href="http://www.revgroup.com/" target="_blank"><img src="<?php echo $menu_4['logo'];?>" alt="rev" /></a>
	                
	            </span>
	        </div>
	    </div>
	</div>
	<div id="boxed-wrapper">
		<div class="fusion-sides-frame"></div>
		<div id="wrapper" class="<?php echo esc_attr( $wrapper_class ); ?>">
			<div id="home" style="position:relative;top:-1px;"></div>
			<?php if ( has_action( 'avada_render_header' ) ) : ?>
				<?php do_action( 'avada_render_header' ); ?>
			<?php else : ?>

				<?php avada_header_template( 'below', ( is_archive() || Avada_Helper::bbp_is_topic_tag() ) && ! ( class_exists( 'WooCommerce' ) && is_shop() ) ); ?>
				<?php if ( 'left' === fusion_get_option( 'header_position' ) || 'right' === fusion_get_option( 'header_position' ) ) : ?>
					<?php avada_side_header(); ?>
				<?php endif; ?>

				<?php avada_sliders_container(); ?>

				<?php avada_header_template( 'above', ( is_archive() || Avada_Helper::bbp_is_topic_tag() ) && ! ( class_exists( 'WooCommerce' ) && is_shop() ) ); ?>

			<?php endif; ?>

			<?php avada_current_page_title_bar( $c_page_id ); ?>

			<?php
			$row_css    = '';
			$main_class = '';

			if ( apply_filters( 'fusion_is_hundred_percent_template', false, $c_page_id ) ) {
				$row_css    = 'max-width:100%;';
				$main_class = 'width-100';
			}

			if ( fusion_get_option( 'content_bg_full' ) && 'no' !== fusion_get_option( 'content_bg_full' ) ) {
				$main_class .= ' full-bg';
			}
			do_action( 'avada_before_main_container' );
			?>
			<main id="main" class="clearfix <?php echo esc_attr( $main_class ); ?>">
				<div class="fusion-row" style="<?php echo esc_attr( $row_css ); ?>">
