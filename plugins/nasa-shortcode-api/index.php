<?php
/**
* Plugin Name: Nasa Shortcode Api
* Description: A plugin that allows you to use APOD (Astronomy Picture Of The Day) and NeoWs (Near Earth Object Web Service)
* Version: 1.0
* Author: jimmyontheroad
* Author URI: http://jimmyontheroad.online/
**/

function nasa_add_admin_page() {	
	//Generate  Menu Pages
	add_menu_page( 'NASA Plugin Options', 'NASA Shortcode', 'manage_options', 'nasa_apod', 'nasa_create_page', plugin_dir_url( __FILE__ ) . '/media/icon-dashboard-nasa.png', 110 );

	//Generate  Submenu Pages
	add_submenu_page( 'nasa_apod', 'Astronomy Picture Of The Day', 'APOD', 'manage_options', 'nasa_apod', 'nasa_create_page' );
	add_submenu_page( 'nasa_apod', 'Near Earth Object Web Service', 'Asteroids - NeoWs', 'manage_options', 'nasa_neo_feed', 'nasa_neo_feed_create_page');
}
//Activate Menu
add_action( 'admin_menu', 'nasa_add_admin_page' );

//Activate Custom Settings
add_action( 'admin_init', 'nasa_custom_settings' );

//Load CSS And Script
function nasa_enqueue_admin_script( $hook ) {  

	if( 'toplevel_page_nasa_apod' == $hook or 'nasa-shortcode_page_nasa_neo_feed' == $hook ){ 
		wp_enqueue_style( 'dp', plugin_dir_url( __FILE__ ) . 'css/nasa.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), '4.2.1', 'all' );

	    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'js/nasa.js', array('jquery'), '1.0' );
	    wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery' , plugin_dir_url( __FILE__ ) . 'js/jquery.js', false, '3.4.0', true );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array('jquery'), '4.2.1', true );

	} else { return; }
}

add_action('admin_enqueue_scripts', 'nasa_enqueue_admin_script');

function nasa_enqueue_script( ) {  
		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), '4.2.1', 'all' );
		wp_enqueue_style( 'dp', plugin_dir_url( __FILE__ ) . 'css/neo.css', array(), '1.0.0', 'all' );

	    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'js/nasa.js', array('jquery'), '1.0' );
	    wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery' , plugin_dir_url( __FILE__ ) . 'js/jquery.js', false, '3.4.0', true );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array('jquery'), '4.2.1', true );
}

add_action('wp_enqueue_scripts', 'nasa_enqueue_script');

//Register Settings
function nasa_custom_settings() {
// apod options	
	register_setting( 'nasa-options', 'apod_options');
	add_settings_section( 'nasa-section', 'APOD (Astronomy Picture of the Day)', 'nasa_section_callback', 'nasa_apod');
	add_settings_field( 'nasa-apod-shortcode-1', '[apod image="left"]', 'nasa_apod_shortcode_1', 'nasa_apod', 'nasa-section');
	add_settings_field( 'nasa-apod-shortcode-2', '[apod]', 'nasa_apod_shortcode_2', 'nasa_apod', 'nasa-section');
	add_settings_field( 'nasa-apod-shortcode-3', '[apod image="right"]', 'nasa_apod_shortcode_3', 'nasa_apod', 'nasa-section');
	add_settings_field( 'nasa-apod-shortcode-4', '[apod date="false"]', 'nasa_apod_shortcode_4', 'nasa_apod', 'nasa-section');
	add_settings_field( 'nasa-apod-shortcode-5', '[apod title="false"]', 'nasa_apod_shortcode_5', 'nasa_apod', 'nasa-section');
	add_settings_field( 'nasa-apod-shortcode-6', '[apod explanation="false"]', 'nasa_apod_shortcode_6', 'nasa_apod', 'nasa-section');

// Neo's feed options
	register_setting( 'nasa-options', 'neo_feed_options');
	add_settings_section( 'nasa-neo', 'Have a glance at the NASA API', 'nasa_section_callback', 'nasa_neo');
	add_settings_field( 'nasa-neo-feed', '[neo title="true" dateRange="true"]', 'nasa_neo_feed_options', 'nasa_neo', 'nasa-neo');
}	

function nasa_section_callback() {
}

function nasa_apod_shortcode_1() {
	echo '<img width="200" src="'.plugin_dir_url( __FILE__ ) .'/media/apod-shortcode-left.jpg"/>';
}

function nasa_apod_shortcode_2() {
	echo '<img width="200" src="'.plugin_dir_url( __FILE__ ) .'/media/apod-shortcode-center.jpg"/>';
}

function nasa_apod_shortcode_3() {
	echo '<img width="200" src="'.plugin_dir_url( __FILE__ ) .'/media/apod-shortcode-right.jpg"/>';
}

function nasa_apod_shortcode_4() {
	echo '<img width="200" src="'.plugin_dir_url( __FILE__ ) .'/media/apod-shortcode-date-false.jpg"/>';
}

function nasa_apod_shortcode_5() {
	echo '<img width="200" src="'.plugin_dir_url( __FILE__ ) .'/media/apod-shortcode-title-false.jpg"/>';
}

function nasa_apod_shortcode_6() {
	echo '<img width="200" src="'.plugin_dir_url( __FILE__ ) .'/media/apod-shortcode-explanation-false.jpg"/>';
}

function nasa_create_page() {
	require_once( plugin_dir_path( __FILE__ ) . '/inc/nasa-apod-admin.php' );
}
function nasa_neo_feed_create_page() {
	require_once( plugin_dir_path( __FILE__ ) . '/inc/nasa-neo-admin.php' );
}

function nasa_neo_feed_options() {
echo '<div class="neoFeed"><h4>Retrieve a list of Asteroids based on their closest approach date to Earth.</h4><h5>Date Range (YYYY-MM-DD - maximum 7 days)</h5><form><fieldset><label for="startDateValue">Start Date</label><input type="text" name="startDateValue" id="startDateValue"><br><label for="endDateValue">End&nbsp;&nbsp;Date</label><input type="text" name="endDateValue" id="endDateValue"><br><button type="submit" id="dateInput" class="btn-warning">Retrieve the list</button></fieldset></form><h2>NEO Results</h2><div id="tableHeader"></div>';
}

function shortcode_nasa_apod($atts){
	
    extract(shortcode_atts(
        array(
    	    'image' => 'center',
    	    'date' => 'true',
    	    'title' => 'true',
			'picture' => '<img id="apod_img_id"/>',
			'explanation' => 'true'
    ), $atts));

	if($date=="false"){
		$apodDate = '';
	}
	else{
		$apodDate = '<p>Picture of the  <span id="apod_date"></span></p>';
	}

	if($explanation=="false"){
		$apodExplanation = '';
	}
	else{
		$apodExplanation = '<p id="apod_explaination" style="text-align:justify;"></p>';
	}

	if($title=="false"){
		$apodTitle = '';
	}
	else{
		$apodTitle = '<h3 id="apod_title"></h3>';
	}

    if($image== "left"){
        $text = ''.$apodDate.'<div class="row"><div class="col-lg-5 col-12">'.$picture.'</div><div class="col-lg-6 col-12">'.$apodTitle.''.$apodExplanation.'</div></div>';
    }
    else if($image== "right"){
        $text = ''.$apodDate.'<div class="row"><div class="col-lg-6 col-12">'.$apodTitle.''.$apodExplanation.'</div><div class="col-lg-5 col-12">'.$picture.'</div></div>';
    }
    else{
    	$text = ''.$apodDate.'<div class="col-12">'.$apodTitle.''.$picture.'</div><div class="col-12">'.$apodExplanation.'</div>'; 	
    }

    return $text;
}

add_shortcode('apod', 'shortcode_nasa_apod');

function shortcode_nasa_neo($atts){
    extract(shortcode_atts(
        array(
    	    'title' => 'true',
    	    'dateRange' => 'true'
    ), $atts));

	if($title=="false"){
		$titleNeo = '';
	}
	else{
		$titleNeo = '<h4>Retrieve a list of Asteroids based on their closest approach date to Earth.</h4>';
	}

	if($dateRange=="false"){
		$dateRangeNeo = '';
	}
	else{
		$dateRangeNeo = '<h5>Date Range (YYYY-MM-DD - maximum 7 days)</h5>';
	}

    return '<div class="neoFeed"><form>'.$titleNeo.''.$dateRangeNeo.'<fieldset><label for="startDateValue">Start Date</label><input type="text" name="startDateValue" id="startDateValue"><br><label for="endDateValue">End&nbsp;&nbsp;Date</label><input type="text" name="endDateValue" id="endDateValue"><br><button type="submit" id="dateInput" class="btn-warning">Retrieve the list</button></fieldset></form><h2>NEO Results</h2><div id="tableHeader"></div>';

}
add_shortcode('neo', 'shortcode_nasa_neo');
