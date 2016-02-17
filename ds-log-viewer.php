<?php
/**
 * Plugin Name:     DS Log Viewer
 * Plugin URI:      https://section214.com/product/ds-log-viewer
 * Description:     Provides quick developer viewing of server logs
 * Version:         1.0.0
 * Author:          Daniel J Griffiths
 * Author URI:      https://section214.com
 * Text Domain:     ds-log-viewer
 *
 * @package         DS_Log_Viewer
 * @author          Daniel J Griffiths <dgriffiths@section214.com>
 * @copyright       Copyright (c) 2015, Daniel J Griffiths
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	exit;
}


if( ! class_exists( 'DS_Log_Viewer' ) ) {


	/**
	 * Main DS_Log_Viewer class
	 *
	 * @since       1.0.0
	 */
	class DS_Log_Viewer {


		/**
		 * @var         DS_Log_Viewer $instance The one true DS_Log_Viewer
		 * @since       1.0.0
		 */
		private static $instance;


		/**
		 * @var         object $settings The DS_Log_Viewer settings object
		 * @since       1.0.0
		 */
		public $settings;


		/**
		 * Get active instance
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      object self::$instance The one true DS_Log_Viewer
		 */
		public static function instance() {
			if( ! self::$instance ) {
				self::$instance = new DS_Log_Viewer();
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->load_textdomain();
				self::$instance->hooks();
			}

			return self::$instance;
		}


		/**
		 * Setup plugin constants
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		public function setup_constants() {
			// Plugin version
			define( 'DS_LOG_VIEWER_VER', '1.0.0' );

			// Plugin path
			define( 'DS_LOG_VIEWER_DIR', plugin_dir_path( __FILE__ ) );

			// Plugin URL
			define( 'DS_LOG_VIEWER_URL', plugin_dir_url( __FILE__ ) );

			// Plugin file
			define( 'DS_LOG_VIEWER_FILE', __FILE__ );
		}


		/**
		 * Include necessary files
		 *
		 * @access      private
		 * @since       1.0.0
		 * @global      array $ds_log_viewer_options The DS_Log_Viewer settings array
		 * @return      void
		 */
		private function includes() {
			global $ds_log_viewer_options;

			// Load settings
			require_once DS_LOG_VIEWER_DIR . 'includes/admin/settings/register.php';

			if( ! class_exists( 'S214_Settings' ) ) {
				require_once DS_LOG_VIEWER_DIR . 'includes/libraries/s214-settings/source/class.s214-settings.php';
			}
			$this->settings        = new S214_Settings( 'ds_log_viewer', 'log-viewer' );
			$ds_log_viewer_options = $this->settings->get_settings();

			require_once DS_LOG_VIEWER_DIR . 'includes/functions.php';
			require_once DS_LOG_VIEWER_DIR . 'includes/scripts.php';
			require_once DS_LOG_VIEWER_DIR . 'includes/actions.php';
			require_once DS_LOG_VIEWER_DIR . 'vendor/autoload.php';
		}


		/**
		 * Run action and filter hooks
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function hooks() {

		}


		/**
		 * Internationalization
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public static function load_textdomain() {
			// Set filter for language directory
			$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
			$lang_dir = apply_filters( 'ds_log_viewer_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'ds-log-viewer' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'ds-log-viewer', $locale );

			// Setup paths to current locale file
			$mofile_local   = $lang_dir . $mofile;
			$mofile_global  = WP_LANG_DIR . '/ds-log-viewer/' . $mofile;

			if( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/ds-log-viewer/ folder
				load_textdomain( 'ds-log-viewer', $mofile_global );
			} elseif( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/ds-log-viewer/languages/ folder
				load_textdomain( 'ds-log-viewer', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'ds-log-viewer', false, $lang_dir );
			}
		}
	}
}


/**
 * The main function responsible for returning the one true DS_Log_Viewer
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      DS_Log_Viewer The one true DS_Log_Viewer
 */
function ds_log_viewer() {
	return DS_Log_Viewer::instance();
}
add_action( 'plugins_loaded', 'ds_log_viewer', 9 );
