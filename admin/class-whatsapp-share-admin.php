<?php

/**
 *
 * @package    addonist_Whatsapp_Share
 * @subpackage addonist_Whatsapp_Share/admin
 */

/**
 * @package    addonist_Whatsapp_Share
 * @subpackage addonist_Whatsapp_Share/admin
 * @author     Addonist <info@addonist.com>
 */

 add_action('admin_menu', 'whatsapp_share_admin');
 
function whatsapp_share_admin(){
	$options = array();
	if ( empty ( $GLOBALS['admin_page_hooks']['addonist_menu'] ) )
		add_menu_page('Addonist', 'Addonist', '', 'addonist_menu', 'addonist_menu', 'http://www.addonist.com/wp-content/uploads/2016/03/plug_icon.png');
		add_submenu_page('addonist_menu', 'Whatsapp Share ', 'Whatsapp Share ', 'manage_options', 'addonist-whatsapp-share', 'whatsapp_share_main');
}
 
function whatsapp_share_main(){
			echo"<p><div class=premium><a href=http://www.addonist.com/shop/whatsapp-share><div class=prembutton><div class=prembutext><span class=prembutext_header>UPGRADE</span><br>to premium version</div></div></a><div class=ptext>Upgrade to the premium version and enjoy from all features of <b>Addonist Whatsapp Share Pro</b>.</div></div></p>";
	global $options;

	wp_register_style( 'style_css', plugins_url('style.css', __FILE__) );
	wp_enqueue_style( 'style_css' );
	global $wpdb;
	if( isset( $_GET[ 'tab' ] ) )
		$active_tab = $_GET[ 'tab' ];
	else
		$active_tab = 'statistics';
    echo "<h1>Whatsapp Share</h1>";

	?>
	<h2 class="nav-tab-wrapper" style="     width: 95%;   border-bottom: 1px solid #ccc;
    margin: 0;
    padding: 9px 0 0 15px;
    line-height: inherit;">
    <a href="?page=addonist-whatsapp-share&tab=statistics" class="nav-tab <?php echo $active_tab == 'statistics' ? 'nav-tab-active' : ''; ?>">Statistics</a>
	<a href="?page=addonist-whatsapp-share&tab=settings_options" class="nav-tab <?php echo $active_tab == 'settings_options' ? 'nav-tab-active' : ''; ?>">Settings</a>
	<a href="?page=addonist-whatsapp-share&tab=premium" class="nav-tab <?php echo $active_tab == 'premium' ? 'nav-tab-active' : ''; ?>">Premium Version</a>

</h2>
<?php

if($active_tab=='settings_options'){
	if(isset($_POST['submit']))
	{ 
		$options['addonist-whatsapp-share-label']			= esc_html( $_POST['label'] );;
		$options['addonist-whatsapp-share-massage']			= esc_html( $_POST['massage'] );
		$options['addonist-whatsapp-share-success_update']	= esc_html( 'Updated!' );
		update_option('addonist-whatsapp-share',$options);

	}
	echo"<div style='padding: 5px;    width: 95%; border-width: 0px 1px 1px; background-color:white; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204);'>";
	echo "<h2>Settings</h2>";

	$options		= get_option('addonist-whatsapp-share');
	$label			= $options['addonist-whatsapp-share-label'];
	$massage		= $options['addonist-whatsapp-share-massage'];
	echo"<form action='' method='post'>
	<table>
	  <tr>
    <td width=20%><h4>License</h4></td>
    <td>License Key:</td>
    <td><input type='text' name='license_input' value='-license' size=50 disabled><strong style='color:green'>Verified!</strong></td>
  </tr>
 <tr>
    <td><h4>Share Button</h4></td>
    <td>Label:</td>
    <td><input type='text' name='label' value='{$label}' size=10/></td>
  </tr>
 
  <tr>
    <td><h4>Share Massage</h4></td>
    <td>Massage:</td>
    <td><input type='text' name='massage' value='{$massage}' size=50/></td>
  </tr>
  <tr>
    <td rowspan=3><h4>Enable on</h4></td>
    <td>Post</td>
    <td><input type=checkbox checked disabled></td>
  </tr>
      <td>Page</td>
    <td><input type=checkbox checked disabled></td>
  </tr>
  <tr>
    <td>Product</td>
    <td><input type=checkbox disabled></td>
  </tr></table>";
	echo"<input type='submit' name='submit' class='button save_order button-primary tips' value='Save'>";
	echo"</form><br></div>";
}

	
	if($active_tab=='statistics'){
	echo"<div style='padding: 5px;    width: 95%; border-width: 0px 1px 1px; background-color:white; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204);'>";
	echo "<h2>Statistics <font color=red> EXAMPLES</font></h2>";
	echo "<Table class='wp-list-table widefat fixed striped posts'>
		<thead><tr>
			<th><strong>Type</strong></th>
			<th><strong>Source</strong></th>
			<th><strong>Count</strong></th>
			<th><strong>Date</strong></th>
		</tr></thead>
		<tbody>
		<Tr>
			<td><a href=#>Product</a></td>
			<td><a href=#>SKU#1</a></td>
			<td><a href=#>38</a></td>
			<td><a href=#>2016-02-11 07:10:03</a></td>
		</tr>
		<Tr>
			<td><a href=#>Post</a></td>
			<td><a href=#>How to install WP plugin</a></td>
			<td><a href=#>29</a></td>
			<td><a href=#>2016-02-01 09:14:33</a></td>
		</tr>
		<Tr>
			<td><a href=#>Page</a></td>
			<td><a href=#>Contact Us</a></td>
			<td><a href=#>98</a></td>
			<td><a href=#>2016-02-21 12:17:23</a></td>
		</tr>
		</tbody>
		</table><br></div>";	
	
	}

	if($active_tab=='premium'){
		$images_dir = plugins_url('/addonist-whatsapp-share/images/');
		echo "<center><h1 class=premium_title>ADDONIST WHATSAPP SHARE PRO - PREMIUM FEATURES</h1></center>";
	echo"<div class='divTable'>
			<div class='divTableBody'>
			<div class='divTableRow'>
			<div class='divTableCell'>
			<div class='divTable'>
			<div class='divTableBody'>
			<div class='divTableRow'>
			<div class='divTableCell'><h3>GET STATISTICS FOR EVEY SHERED</h3></div>
			</div>
			<div class='divTableRow'>
			<div class='divTableCell'><img src=".$images_dir."/paid1.png></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class='divTableRow1'>
			<div class='divTableCell'>
			<div class='divTable'>
			<div class='divTableBody'>
			<div class='divTableRow1'>
			<div class='divTableCell'><h3>SHARE BUTTON FOR PRODUCTS</h3></div>
			<div class='divTableCell'><img src=".$images_dir."/paid4.png></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class='divTableRow'>
			<div class='divTableCell'>
			<div class='divTable'>
			<div class='divTableBody'>
			<div class='divTableRow'>
			<div class='divTableCell'><img src=".$images_dir."/paid2.png></div>
			<div class='divTableCell'><h3>CHOOSE WHERE TO ADD THE BUTTON AUTOMATICALLY<h3></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class='divTableRow1'>
			<div class='divTableCell'>
			<div class='divTable'>
			<div class='divTableBody'>
			<div class='divTableRow1'>
			<div class='divTableCell'><h3>SHORT-URL FOR MESSEAGES - SIMPLY AND POWERFUL</h3></div>
			<div class='divTableCell'><img src=".$images_dir."/paid3.png></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
</div>";
			echo"<p><div class=premium><a href=http://www.addonist.com/shop/whatsapp-share><div class=prembutton><div class=prembutext><span class=prembutext_header>UPGRADE</span><br>to premium version</div></div></a><div class=ptext>Upgrade to the premium version and enjoy from all features of <b>Addonist Whatsapp Share Pro</b>.</div></div></p>";

	}
	
}
