<?php
/*
Plugin Name: Modern Sticky Adbar For Mobile and PC
Plugin URI: http://themesfarmer.com/modern-sticky-adbar
Author: Sajal Ahmed
Author URI: http://sajalahmed.com/
Description: modern Adbar for mobile and pc both and also have options to deactived anyone. 
Version: 1.0
Tags: Modern Sticky Ad Bar, Sticky Ad Bar, mobile ad, stick ad banner, stick ad bar, floating ad banner, floating ad bar, newspaper ad bar, blog site ad bar, prothom-alo ad bar style  
License: GPL3
*/

// Enqueue Scripts
function msab_admin_scripts_add() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('msab_script',plugins_url('assets/js/msab_script.js',__FILE__));
}
add_action('admin_enqueue_scripts', 'msab_admin_scripts_add');
function msab_script(){ 
	wp_enqueue_script('sab_bar_script1',plugins_url('assets/js/msab_script.js',__FILE__),array( 'jquery' ));
}
add_filter('init','msab_script');
// Register Menu Page
add_action('admin_menu','modern_sticky_adbar_admin_menupage');
function modern_sticky_adbar_admin_menupage(){
	add_menu_page( 'modern Sticky Adbar Options', "modern AdBar Options",'administrator', 'modern_sticky_adbar','modern_adbar_options','dashicons-slides');
	add_submenu_page( 'modern_sticky_adbar', 'Place Your Ad Code', 'Ad Code', 'administrator', 'modern_adbar_place_code', 'modern_adbar_place_code' );
}
// Adding Setting Page Link
function modern_stikcy_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=modern_sticky_adbar">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'modern_stikcy_settings_link' );
// Option Panel
function modern_adbar_options(){ 
	echo "<h1>modern Sticky AdBar : Options</h1>"; ?>
<div class='msab_formLayout'>
	<form action="options.php" method="post" >

		<?php settings_fields( 'modern_adbar_options_picker' );?>
		<?php do_settings_sections( 'modern_adbar_options_picker' );?>
		<br>
		<label for="msab_enable">Enable the bar: </label>
		<input class="checkbox" type="checkbox" name="msab_enable" value="Enable"
		<?php checked('Enable',get_option('msab_enable')); ?> >
		<br>
		<label for="mmsab_mobile_only">Show it on mobile ONLY: </label>
		<input class="checkbox" type="checkbox" name="msab_mobile_only" value="Enable"
		<?php checked('Enable',get_option('msab_mobile_only')); ?> >
		<br>	
		<label> </label>
		<div class="colonne">Default</div>
		<div class="colonne">Mobile</div>	
		<br>
		<label for="msab_adbar_style">Ad Bar Styles</label>
		<select name="msab_adbar_style">
			<option value="style1"
			<?php selected('style1',get_option('msab_adbar_style')); ?>	> Style One </option>
			<option value="style2"
			<?php selected('style2',get_option('msab_adbar_style')); ?>	> Style Two </option>
		</select>		
		<legend>Choose Your Adbar Style</legend>
		<br>
		<label for='msab_background_color'>Color Background (#): </label>
		<input class='ub_color_picker' type="text" name="msab_background_color" value="<?php echo get_option('msab_background_color'); ?>">
		<input class='ub_color_picker' type="text" name="msab_background_color_mob" value="<?php echo get_option('msab_background_color_mob'); ?>">
		<legend>blank = transparency</legend>
		<br>
		<label for='msab_bar_height'>Bar Width (%):</label>
		<input type="number" name='msab_bar_width' value='<?php echo get_option('msab_bar_width'); ?>' placeholder='Enter value in %'>
		<input type="number" name='msab_bar_width_mob' value='<?php echo get_option('msab_bar_width_mob'); ?>' placeholder='Enter value in %'>
		<legend>put 100 if you're not sure</legend>
		<br>
		<label for='msab_bar_height'>Bar Height (px):</label>
		<input type="number" name='msab_bar_height' value='<?php echo get_option('msab_bar_height'); ?>' placeholder='Enter value in px'>
		<input type="number" name='msab_bar_height_mob' value='<?php echo get_option('msab_bar_height_mob'); ?>' placeholder='Enter value in px'>
		<legend>useful for responsive ads</legend>
		<br>
		<?php submit_button('Save Changes');  ?>		
	</form>
</div>		
<style type="text/css">	
	h1
	{
		text-align:center;
	}
	.msab_formLayout
    {
        padding: 10px;
        width: 750px;
        margin: 0 auto;
    }
    .msab_formLayout select{
		width:262px;
	}
    .msab_formLayout label 
    {
        display: block;
        width: 200px;
        float: left;
        margin-bottom: 10px;
        margin-left: 20px;
    }
    .msab_formLayout legend 
    {
        display: block;
        width: 200px;
        float: left;
        margin-bottom: 10px;
        margin-left: 20px;
    }
    .msab_formLayout input,select{
        display: block;
        width: 130px;
        float: left;
        margin-bottom: 10px;

    }
    .colonne{
        display: block;
        width: 130px;
        float: left;
		text-align:center;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: bold;

    }
    .msab_formLayout textarea{
        float: left;
        margin-bottom: 10px;

    }
    .msab_formLayout label
    {
        text-align: left;
		vertical-align: bottom;
        padding-right: 20px;
        font-size: 14px;
        font-weight: bold;
    }
    br
    {
        clear: left;
    }
    .checkbox, .radio
	{
    	width:15px !important;
    	height: 15px !important;
    }
</style>
<?php
}
// Add Ad Code Option
function modern_adbar_place_code(){
	echo "<h1>modern AdBar: Place Your Ad Code</h1>";?>
<div class='msab_formLayout'>
<form action="options.php" method="post" >
	<?php settings_fields( 'modern_adbar_options_picker_content' );?>
	<?php do_settings_sections( 'modern_adbar_options_picker_content' );?>
	<br>	
	<?php $settings = array('media_buttons'=> false,'msab_content','textarea_rows'=>10);
	$msab_content = get_option('msab_content');
 	wp_editor($msab_content,'msab_content',$settings); ?>
	<br>
	
	<?php submit_button('Save Changes');  ?>		
</form>
</div>		
<style type="text/css">	
	h1
	{
		text-align:center;
	}
	.msab_formLayout
    {
        padding: 10px;
        width: 750px;
        margin: 0 auto;
    }
    br
    {
        clear: left;
    }
	#wp-msab_content-editor-tools{
		display:block;
	}
</style>
<?php
}
// Adding Design to Footer 
add_filter('wp_footer',"msab_footer_adding");
function msab_footer_adding(){
	$msab_enable = get_option('msab_enable');
	$msab_mobile_only = get_option('msab_mobile_only');	
	$msab_content = get_option('msab_content');
	$msab_adbar_style = get_option('msab_adbar_style');
	$msab_background_color =get_option('msab_background_color');
	$msab_background_color_mob =get_option('msab_background_color_mob');	
	$msab_bar_width = get_option('msab_bar_width');
	$msab_bar_width_mob = get_option('msab_bar_width_mob');
	$msab_bar_height = get_option('msab_bar_height');
	$msab_bar_height_mob = get_option('msab_bar_height_mob');

	if (get_option('msab_enable')=='Enable') {
		if (get_option('msab_mobile_only')=='Enable') {
			if  ( wp_is_mobile() ) {
				include 'assets/modern_adbar.html';
			}			
		} else {
			include 'assets/modern_adbar.html';			
		}				
		
	}
}
// Adding data to head
add_action('wp_head','msab_adding_head');
function msab_adding_head(){
	$msab_enable = get_option('msab_enable');
	$msab_mobile_only = get_option('msab_mobile_only');	
	$msab_content = get_option('msab_content');
	$msab_adbar_style = get_option('msab_adbar_style');
	$msab_background_color =get_option('msab_background_color');
	$msab_background_color_mob =get_option('msab_background_color_mob');	
	$msab_bar_height = get_option('msab_bar_height');
	$msab_bar_height_mob = get_option('msab_bar_height_mob');
	$msab_bar_width = get_option('msab_bar_width');
	$msab_bar_width_mob = get_option('msab_bar_width_mob');
}
// Registering Activation
register_activation_hook(__FILE__,'msab_activating_options');
function msab_activating_options(){
	add_option('msab_enable','Enable');
	add_option('msab_mobile_only','Enable');	
	add_option('msab_content','Put Some Content Here!');
	add_option('msab_adbar_style','style1');
	add_option('msab_background_color','#fff');
	add_option('msab_background_color_mob','#fff');	
	add_option('msab_bar_width','100');
	add_option('msab_bar_width_mob','100');	
	add_option('msab_bar_height','5');
	add_option('msab_bar_height_mob','5');	
}
// Register Settings
add_action('admin_init','msab_setting_reg');
function msab_setting_reg(){
	register_setting( 'modern_adbar_options_picker', 'msab_enable');
	register_setting( 'modern_adbar_options_picker', 'msab_mobile_only');		
	register_setting('modern_adbar_options_picker_content','msab_content');
	register_setting('modern_adbar_options_picker','msab_adbar_style');
	register_setting('modern_adbar_options_picker','msab_background_color');
	register_setting('modern_adbar_options_picker','msab_background_color_mob');
	register_setting('modern_adbar_options_picker','msab_bar_height');
	register_setting('modern_adbar_options_picker','msab_bar_height_mob');
	register_setting('modern_adbar_options_picker','msab_bar_width');
	register_setting('modern_adbar_options_picker','msab_bar_width_mob');	
}

 ?>