<?php
/**
 * Scripts
 *
 * @package     DS_Log_Viewer\Scripts
 * @since       1.0.0
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Load admin scripts
 *
 * @since		1.0.0
 * @return		void
 */
function ds_log_viewer_admin_scripts() {
	if( ! isset( $_GET['page'] ) || $_GET['page'] != 'ds_log_viewer-settings' ) {
		return;
	}

	wp_enqueue_style( 'ds-log-viewer', DS_LOG_VIEWER_URL . 'assets/css/log-viewer.css', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_script( 'ds-log-viewer', DS_LOG_VIEWER_URL . 'assets/js/log-viewer.js', array( 'jquery' ), DS_LOG_VIEWER_VER );

	// Codemirror
	wp_enqueue_style( 'ds-log-viewer-cm', DS_LOG_VIEWER_URL . 'assets/js/codemirror/lib/codemirror.css', array( 'jquery' ), DS_LOG_VIEWER_VER );
	wp_enqueue_style( 'ds-log-viewer-cm-theme', DS_LOG_VIEWER_URL . 'assets/js/codemirror/theme/eclipse.css', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_style( 'ds-log-viewer-cm-dialog', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/dialog/dialog.css', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_style( 'ds-log-viewer-cm-simple-scrollbars', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/scroll/simplescrollbars.css', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_style( 'ds-log-viewer-cm-match-on-scrollbar', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/search/matchesonscrollbar.css', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_script( 'ds-log-viewer-cm', DS_LOG_VIEWER_URL . 'assets/js/codemirror/lib/codemirror.js', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_script( 'ds-log-viewer-cm-search', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/search/search.js', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_script( 'ds-log-viewer-cm-search-cursor', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/search/searchcursor.js', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_script( 'ds-log-viewer-cm-jump-to-line', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/search/jump-to-line.js', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_script( 'ds-log-viewer-cm-match-on-scrollbar', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/search/matchesonscrollbar.js', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_script( 'ds-log-viewer-cm-dialog', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/dialog/dialog.js', array(), DS_LOG_VIEWER_VER );
	wp_enqueue_script( 'ds-log-viewer-cm-annotate-scrollbar', DS_LOG_VIEWER_URL . 'assets/js/codemirror/addon/scroll/annotatescrollbar.js', array(), DS_LOG_VIEWER_VER );
}
add_action( 'admin_enqueue_scripts', 'ds_log_viewer_admin_scripts' );