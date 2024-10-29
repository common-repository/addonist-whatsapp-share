<?php

/**

 * @link              http://www.addonist.com
 * @since             1.0.0
 * @package           Addonist_Whatsapp_Share
 *
 * @wordpress-plugin
 * Plugin Name:       Addonist WhatsApp Share 
 * Description:       Add share button into posts and pages.
 * Version:           1.0.0
 * Author:            Addonist
 * Author URI:        http://www.addonist.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       addonist-whatsapp-share
*/

require_once plugin_dir_path( __FILE__ ) . 'admin/class-whatsapp-share-admin.php';

function activate_addonist_whatsapp_share() {
	$options = array();
	$options['addonist-whatsapp-share-massage'] = 'I loved this link and I wanted to share with you';
	$options['addonist-whatsapp-share-label'] = 'Share';
	update_option('addonist-whatsapp-share',$options);
}
register_activation_hook( __FILE__, 'activate_addonist_whatsapp_share' );
add_filter ('the_content', 'whatsapp_share');


function whatsapp_share($content)
{
	wp_register_style( 'style_css_whatsapp', plugins_url('/css/style.css', __FILE__) );
	wp_enqueue_style( 'style_css_whatsapp' );
	if(is_rtl())
	{
		wp_register_style( 'rtl_css_whatsapp', plugins_url('/css/rtl.css', __FILE__) );
		wp_enqueue_style( 'rtl_css_whatsapp' );
	}	
	global $post;
	$options		= get_option('addonist-whatsapp-share');
	$massage		= $options['addonist-whatsapp-share-massage'];
	$label			= $options['addonist-whatsapp-share-label'];
	if($massage && (is_single() || is_page()))
	{
		if (wp_is_mobile()) 
		{
			$link =get_permalink( $post->ID );
			echo"<p><a href='whatsapp://send?text={$message} - {$link}' role='button' name='whatsappsend' class='whatsapp'>".$label."</a><br><br></p>";
		}
	}

	return $content;

}

function whatsapp_print_shortcode(){
	global $post;
	$options		= get_option('addonist-whatsapp-share-pro');
	$license		= $options['addonist-whatsapp-share-pro-license_key'];
	$label			= $options['addonist-whatsapp-share-pro-label'];
	$massage		= $options['addonist-whatsapp-share-pro-massage'];
	$link 			= get_permalink( $post->ID );
	wp_register_style( 'style_css_whatsapp', plugins_url('/css/style.css', __FILE__) );
	wp_enqueue_style( 'style_css_whatsapp' );
	if(is_rtl())
	{
		wp_register_style( 'rtl_css_whatsapp', plugins_url('/css/rtl.css', __FILE__) );
		wp_enqueue_style( 'rtl_css_whatsapp' );
	}	
	if(wp_is_mobile() && $massage && $label)
	{
		if(isset($_POST['whatsappsend']) &&$_POST['whatsapp_status']==1)
				echo"<script>window.location = 'whatsapp://send?text={$massage} - {$link}'</script>";
	return "<form action='' method='post' id='formaddonist_whatsapp_shortcode' style='display:inline;'>
			<input type=hidden name=whatsapp_status value=1>
			<button type='submit' name='whatsappsend' class='whatsapp_shortcode'> {$label}</button></form>";
				
				
	}
}

add_shortcode('addonist_whatsapp', 'whatsapp_print_shortcode');

