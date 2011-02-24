<?php

	// start the session
	session_start();


	
	#--------------------------------
	# Load the class
	#--------------------------------	
	require_once "application/config/constants.php";
	require_once LIBRARY_DIR . "loader.class.php";

	
	

	#--------------------------------
	# Init Loader class
	#--------------------------------	
	$loader = new Loader;
	$loader->database_connect();		// Connect the database
	$loader->load_settings();			// load the settings
	$loader->set_language('en');		// set the language
	$loader->login();					// do login ( you must pass login=your_login and password=your_password)
	$loader->set_theme();				// set theme
	$loader->set_page('index');			// set page layout
	$loader->init_route();				// init the route



	#--------------------------------
	# Auto Load the Controller
	# init_route set the controller/action/params
	# to load the controller
	#--------------------------------
	$html = $loader->load_controller( $loader->get_selected_controller(), $loader->get_selected_action(), $loader->get_selected_params() );

	
	
	#--------------------------------
	# Add Style and Script 
	#--------------------------------
	global $script, $style, $javascript, $javascript_onload;
	if( $style )
		foreach( $style as $s )
			$html .= '<link rel="stylesheet" href="'.$s.'" type="text/css" />' . "\n";

	if( $script )
		foreach( $script as $s )
			$html .= '<script src="'.$s.'" type="text/javascript"></script>' . "\n";

	if( $javascript_onload ) $javascript .=  "\n" . "$(function(){" . "\n" . "	$javascript_onload" . "\n" . "});" . "\n";
	if( $javascript )
		$html .= "<script type=\"text/javascript\">" . "\n" .$javascript . "\n" . "</script>;";
	
	echo $html;
	#--------------------------------
	
	
	
	


	
?>