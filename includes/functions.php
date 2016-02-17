<?php
/**
 * Helper functions
 *
 * @package     DS_Log_Viewer\Functions
 * @since       1.0.0
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Get the DS root path
 *
 * @since       1.0.0
 * @return      string $root_path The DS root path
 */
function ds_log_viewer_get_root_path() {
	$root_path = get_transient( 'ds_root_path' );

	if( ! $root_path ) {
		$root_dir = dirname( __FILE__ );

		// Remove the plugin directory.
		$root_dir = explode( '/', $root_dir );

		foreach( $root_dir as $index => $dir ) {
			if( $dir == 'xamppfiles' ) {
				$max = $index;
				$max++;
				break;
			}
		}

		$root_dir = array_slice( $root_dir, 0, $max );

		$root_path = implode( '/', $root_dir );

		set_transient( 'ds_root_path', $root_path, 0 );
	}

	return $root_path;
}