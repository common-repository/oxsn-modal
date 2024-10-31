<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/*
Plugin Name: OXSN Modal
Plugin URI: https://wordpress.org/plugins/oxsn-modal/
Description: This plugin adds helpful modal shortcodes with quicktags!
Author: oxsn
Author URI: https://oxsn.com/
Version: 0.0.6
*/


define( 'oxsn_modal_plugin_basename', plugin_basename( __FILE__ ) );
define( 'oxsn_modal_plugin_dir_path', plugin_dir_path( __FILE__ ) );
define( 'oxsn_modal_plugin_dir_url', plugin_dir_url( __FILE__ ) );

if ( ! function_exists ( 'oxsn_modal_settings_link' ) ) {

	add_filter( 'plugin_action_links', 'oxsn_modal_settings_link', 10, 2 );
	function oxsn_modal_settings_link( $links, $file ) {

		if ( $file != oxsn_modal_plugin_basename )
		return $links;
		$settings_page = '<a href="' . menu_page_url( 'oxsn-modal', false ) . '">' . esc_html( __( 'Settings', 'oxsn-modal' ) ) . '</a>';
		array_unshift( $links, $settings_page );
		return $links;

	}

}


?><?php


/* OXSN Dashboard Tab */

if ( !function_exists('oxsn_dashboard_tab_nav_item') ) {

	add_action('admin_menu', 'oxsn_dashboard_tab_nav_item');
	function oxsn_dashboard_tab_nav_item() {

		add_menu_page('OXSN', 'OXSN', 'manage_options', 'oxsn-dashboard', 'oxsn_dashboard_tab' );

	}

}

if ( !function_exists('oxsn_dashboard_tab') ) {

	function oxsn_dashboard_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap">
		
			<h2>OXSN / Digital Agency</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Coming Soon</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?><?php


/* OXSN Plugin Tab */

if ( ! function_exists ( 'oxsn_modal_plugin_tab_nav_item' ) ) {

	add_action('admin_menu', 'oxsn_modal_plugin_tab_nav_item', 99);
	function oxsn_modal_plugin_tab_nav_item() {

		add_submenu_page('oxsn-dashboard', 'OXSN Modal', 'Modal', 'manage_options', 'oxsn-modal', 'oxsn_modal_plugin_tab');

	}

}

if ( !function_exists('oxsn_modal_plugin_tab') ) {

	function oxsn_modal_plugin_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap oxsn_settings_page">
		
			<h2>OXSN / Modal Plugin</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p>Coming soon.</p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Custom Project</h3>

							<div class="inside">

								<p>Want us to build you a custom project?</p>

								<p><a href="mailto:brief@oxsn.com?Subject=Custom%20Project%20Request%21&Body=Please%20answer%20the%20following%20questions%20to%20help%20us%20better%20understand%20your%20needs..%0A%0A1.%20What%20is%20the%20name%20of%20your%20company%3F%0A%0A2.%20What%20are%20the%20concepts%20and%20goals%20of%20your%20project%3F%0A%0A3.%20What%20is%20the%20proposed%20budget%20of%20this%20project%3F" class="button button-primary button-large">Email Us</a></p>

							</div>
							
						</div>

						<div class="postbox">

							<h3 class="hndle cursor_initial">Support</h3>

							<div class="inside">

								<p>Need help with this plugin? Visit the Wordpress plugin page for support..</p>

								<p><a href="https://wordpress.org/support/plugin/oxsn-modal" target="_blank" class="button button-primary button-large">Support</a></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?><?php


/* OXSN Shortcodes */

//[oxsn_modal_inline class="" paired_id="" type=""]
if ( ! function_exists ( 'oxsn_modal_inline_shortcode' ) ) {

	add_shortcode('oxsn_modal_inline', 'oxsn_modal_inline_shortcode');
	function oxsn_modal_inline_shortcode( $atts, $content = null ) {
		$a = shortcode_atts( array(
			'class' => '',
			'id' => '',
			'paired_id' => '',
			'type' => '',
		), $atts );

		$oxsn_modal_inline_class = esc_attr($a['class']);
		if ($oxsn_modal_inline_class != '') :

			$oxsn_modal_inline_class = ' class="oxsn_modal_inline oxsn_fancybox_inline ' . $oxsn_modal_inline_class . '" ';

		else : 

			$oxsn_modal_inline_class = ' class="oxsn_modal_inline oxsn_fancybox_inline" ';

		endif;

		$oxsn_modal_inline_id = esc_attr($a['id']);
		if ($oxsn_modal_inline_id != '') :

			$oxsn_modal_inline_id = ' id="' . $oxsn_modal_inline_id . '" ';

		endif;

		$oxsn_modal_inline_paired_id = esc_attr($a['paired_id']);
		if ($oxsn_modal_inline_paired_id != '') :

			$oxsn_modal_inline_paired_id = strtolower($oxsn_modal_inline_paired_id);
			$oxsn_modal_inline_paired_id = preg_replace("/[\s-]+/", " ", $oxsn_modal_inline_paired_id);
			$oxsn_modal_inline_paired_id = preg_replace("/[\s_]/", "-", $oxsn_modal_inline_paired_id);

		endif;

		$oxsn_modal_inline_type = esc_attr($a['type']);
		if ($oxsn_modal_inline_type == 'link') :

			$oxsn_modal_return = '<a ' . $oxsn_modal_inline_id . ' ' . $oxsn_modal_inline_class . ' href="#' . $oxsn_modal_inline_paired_id . '" ">' . do_shortcode($content) . '</a>';

		else : 

			$oxsn_modal_return = '<div style="display: none"><div id="' . $oxsn_modal_inline_paired_id . '" class="oxsn_fancybox_inline_content">' . do_shortcode($content) . '</div></div>';

		endif;

		return $oxsn_modal_return;

	}

}


?><?php


/* OXSN Quicktags */

if ( ! function_exists ( 'oxsn_modal_quicktags' ) ) {

	add_action( 'admin_print_footer_scripts', 'oxsn_modal_quicktags' );
	function oxsn_modal_quicktags() {

		if ( wp_script_is( 'quicktags' ) ) {

		?>

			<script type="text/javascript">

				QTags.addButton( 'oxsn_modal_inline_quicktag', '[oxsn_modal_inline]', '[oxsn_modal_inline class="" paired_id="" type=""]', '[/oxsn_modal_inline]', 'oxsn_modal_inline', 'Quicktags MODAL INLINE', 301 );

			</script>

		<?php

		}

	}

}


?><?php


/* OXSN Include CSS */

if ( ! function_exists ( 'oxsn_modal_inc_css' ) ) {

	add_action( 'wp_enqueue_scripts', 'oxsn_modal_inc_css' );
	function oxsn_modal_inc_css() {

		wp_enqueue_style( 'oxsn_modal_fancybox_css', oxsn_modal_plugin_dir_url . 'inc/css/jquery.fancybox-1.3.4.css', array(), '1.3.4', 'all' ); 
		wp_enqueue_style( 'oxsn_modal_css', oxsn_modal_plugin_dir_url . 'inc/css/modal.css', array(), '0.0.1', 'all' ); 

	}

}


?><?php


/* OXSN Include JS */

if ( ! function_exists ( 'oxsn_modal_inc_js' ) ) {

	add_action( 'wp_enqueue_scripts', 'oxsn_modal_inc_js' );
	function oxsn_modal_inc_js() {

		wp_enqueue_script( 'oxsn_modal_fancybox_pack_js', oxsn_modal_plugin_dir_url . 'inc/js/jquery.fancybox-1.3.4_patch.js', array(), '1.3.4', 'all' );
		wp_enqueue_script( 'oxsn_modal_js', oxsn_modal_plugin_dir_url . 'inc/js/modal.js', array(), '1.0.0', 'all' ); 

	}

}


?>