<?php
/**
 * Actions
 *
 * @package     DS_Log_Viewer\Actions
 * @since       1.0.0
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;


/**
 * Processes all actions sent via POST and GET by looking for the 'ds-log-viewer-action'
 * request and running do_action() to call the function
 *
 * @since       1.0.0
 * @return      void
 */
function ds_log_viewer_process_actions() {
	if ( isset( $_POST['ds-log-viewer-action'] ) ) {
		do_action( 'ds_log_viewer_' . $_POST['ds-log-viewer-action'], $_POST );
	}

	if ( isset( $_GET['ds-log-viewer-action'] ) ) {
		do_action( 'ds_log_viewer_' . $_GET['ds-log-viewer-action'], $_GET );
	}
}
add_action( 'admin_init', 'ds_log_viewer_process_actions' );


/**
 * Display log
 *
 * @since       1.0.0
 * @return      void
 */
function ds_log_viewer_display_log() {
	$root_dir = ds_log_viewer_get_root_path();

	$adapter = new Local( $root_dir, LOCK_EX, Local::SKIP_LINKS );
	$filesystem = new Filesystem( $adapter );

	// Windows is silly...
	if( PHP_OS !== 'Darwin' ) {
		$logdir = '/apache/logs/';
		$sqldir = '/mysql/data/';
		$ctrlkey = 'Ctrl';
	} else {
		$logdir = '/logs/';
		$sqldir = '/var/mysql/';
		$ctrlkey = 'Cmd';
	}

	$section = isset( $_GET['section'] ) ? $_GET['section'] : 'access_log';

	switch( $section ) {
		case 'apache-access' :
			$errorlog = $logdir . 'access_log';
			break;
		case 'apache-error' :
			$errorlog = $logdir . 'error_log';
			break;
		case 'php-error' :
			$errorlog = $logdir . 'php_error_log';
			break;
		case 'ssl-request' :
			$errorlog = $logdir . 'ssl_request_log';
			break;
		case 'mysql-error' :
			if( PHP_OS !== 'Darwin' ) {
				$errorlog = $sqldir . 'mysql_error.log';
			} else {
				$dir_contents = $filesystem->listContents( $sqldir );
				$files = array();

				foreach( $dir_contents as $fileinfo ) {
					if( isset( $fileinfo['extension'] ) &&  $fileinfo['extension'] == 'err' ) {
						$files[$fileinfo['timestamp']][] = $fileinfo['basename'];
					}
				}

				krsort( $files );

				$errorlog = $sqldir . array_shift( $files )[0];
			}
			break;
		default :
			$errorlog = $logdir . 'access_log';
			break;
	}

	// Windows is silly...
	if( PHP_OS !== 'Darwin' ) {
		$errorlog = str_replace( '_log', '.log', $file );
	}

	if( $filesystem->has( $errorlog ) ) {
		$data = $filesystem->read( $errorlog );
	} else {
		$data = '';
	}
	?>
	<div class="sk-fading-circle">
		<div class="sk-circle1 sk-circle"></div>
		<div class="sk-circle2 sk-circle"></div>
		<div class="sk-circle3 sk-circle"></div>
		<div class="sk-circle4 sk-circle"></div>
		<div class="sk-circle5 sk-circle"></div>
		<div class="sk-circle6 sk-circle"></div>
		<div class="sk-circle7 sk-circle"></div>
		<div class="sk-circle8 sk-circle"></div>
		<div class="sk-circle9 sk-circle"></div>
		<div class="sk-circle10 sk-circle"></div>
		<div class="sk-circle11 sk-circle"></div>
		<div class="sk-circle12 sk-circle"></div>
	</div>

	<textarea id="ds-log-viewer" readonly="readonly" style="display: none"><?php echo $data; ?></textarea>
	<?php
}
add_action( 'ds_log_viewer_display_log', 'ds_log_viewer_display_log' );