<?php
/**
 * Settings
 *
 * @package     DS_Log_Viewer\Admin\Settings\Register
 * @since       1.0.0
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Create the setting menu item
 *
 * @since       1.0.0
 * @param       array $menu The default menu args
 * @return      array $menu Our defined menu args
 */
function ds_log_viewer_create_menu( $menu ) {
	$menu['type']       = 'submenu';
	$menu['parent']     = 'services';
	$menu['page_title'] = __( 'Log Viewer', 'ds-log-viewer' );
	$menu['menu_title'] = __( 'Log Viewer', 'ds-log-viewer' );

	return $menu;
}
add_filter( 'ds_log_viewer_menu', 'ds_log_viewer_create_menu' );


/**
 * Define our settings tabs
 *
 * @since       1.0.0
 * @param       array $tabs The default tabs
 * @return      array $tabs Our defined tabs
 */
function ds_log_viewer_settings_tabs( $tabs ) {
	$tabs['log-viewer'] = __( 'Log Viewer', 'ds-log-viewer' );
	$tabs['settings']   = __( 'Settings', 'ds-log-viewer' );

	return $tabs;
}
add_filter( 'ds_log_viewer_settings_tabs', 'ds_log_viewer_settings_tabs' );


/**
 * Define settings sections
 *
 * @since       1.0.0
 * @param       array $sections The default sections
 * @return      array $sections Our defined sections
 */
function ds_log_viewer_registered_settings_sections( $sections ) {
	$sections = array(
		'log-viewer' => apply_filters( 'ds_log_viewer_settings_sections_log_viewer', array(
			'apache-access' => __( 'Apache Access', 'ds-log-viewer' ),
			'apache-error'  => __( 'Apache Error', 'ds-log-viewer' ),
			'php-error'     => __( 'PHP Error', 'ds-log-viewer' ),
			'mysql-error'   => __( 'MySQL Error', 'ds-log-viewer' ),
			'ssl-access'    => __( 'SSL Access', 'ds-log-viewer' )
		) ),
		'settings' => apply_filters( 'ds_log_viewer_settings_sections_settings', array() )
	);

	return $sections;
}
add_filter( 'ds_log_viewer_registered_settings_sections', 'ds_log_viewer_registered_settings_sections' );


/**
 * Disable save button on support tab
 *
 * @since       1.0.0
 * @return      array $tabs The tabs to disable saving on
 */
function ds_log_viewer_unsavable_tabs() {
	$tabs = array( 'log-viewer' );

	return $tabs;
}
add_filter( 'ds_log_viewer_unsavable_tabs', 'ds_log_viewer_unsavable_tabs' );


/**
 * Define our settings
 *
 * @since       1.0.0
 * @param       array $settings The default settings
 * @return      array $settings Our defined settings
 */
function ds_log_viewer_registered_settings( $settings ) {
	$new_settings = array(
		// Log Viewer
		'log-viewer' => apply_filters( 'ds_log_viewer_settings_log_viewer', array(
			'apache-access' => array(
				array(
					'id'   => 'display_log',
					'name' => __( 'Log File', 'ds-log-viewer' ),
					'desc' => '',
					'type' => 'hook'
				)
			),
			'apache-error' => array(
				array(
					'id'   => 'display_log',
					'name' => __( 'Log File', 'ds-log-viewer' ),
					'desc' => '',
					'type' => 'hook'
				)
			),
			'php-error' => array(
				array(
					'id'   => 'display_log',
					'name' => __( 'Log File', 'ds-log-viewer' ),
					'desc' => '',
					'type' => 'hook'
				)
			),
			'mysql-error' => array(
				array(
					'id'   => 'display_log',
					'name' => __( 'Log File', 'ds-log-viewer' ),
					'desc' => '',
					'type' => 'hook'
				)
			),
			'ssl-access' => array(
				array(
					'id'   => 'display_log',
					'name' => __( 'Log File', 'ds-log-viewer' ),
					'desc' => '',
					'type' => 'hook'
				)
			)
		) ),
		// Settings
		'settings' => apply_filters( 'ds_log_viewer_settings_settings', array(
			array(
				'id'   => 'settings_header',
				'name' => __( 'Log Viewer Settings', 'ds-log-viewer' ),
				'desc' => '',
				'type' => 'header'
			)
		) )
	);

	return array_merge( $settings, $new_settings );
}
add_filter( 'ds_log_viewer_registered_settings', 'ds_log_viewer_registered_settings' );