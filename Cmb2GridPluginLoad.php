<?php

namespace Cmb2Grid;

if ( ! defined( 'CMB2GRID_DIR' ) ) {
	define( 'CMB2GRID_DIR', trailingslashit( dirname( __FILE__ ) ) );
}


if ( ! class_exists( '\Cmb2Grid\Cmb2GridPlugin' ) ) {

	require_once dirname( __FILE__ ) . '/DesignPatterns/Singleton.php';

	class Cmb2GridPlugin extends DesignPatterns\Singleton {

		const VERSION = '1.0';

		protected function __construct() {
			if ( ! is_admin() ) {
				return;
			}

			spl_autoload_register( array( $this, 'auto_load' ) );

			add_action( 'admin_head', array( $this, 'wpHead' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			//$this->test();
		}

		private function test() {
			new Test\Test();
		}

		/**
		 * Auto load our class files.
		 *
		 * @param string $class Class name.
		 *
		 * @return void
		 */
		public function auto_load( $class ) {
			static $prefix;
			static $base_dir;
			static $sep;
			static $length;

			if ( ! isset( $prefix, $base_dir, $sep ) ) {
				// Project-specific namespace prefix.
				$prefix = __NAMESPACE__ . '\\';

				// Base directory for the namespace prefix.
				$base_dir = plugin_dir_path( __FILE__ ); // Has trailing slash.

				// Set directory separator.
				$sep = '/';
				if ( defined( 'DIRECTORY_SEPARATOR' ) ) {
					$sep = DIRECTORY_SEPARATOR;
				}
				$length = strlen( $prefix );
			}

			// Does the class use the namespace prefix?
			if ( strncmp( $prefix, $class, $length ) !== 0 ) {
				// No, move to the next registered autoloader.
				return;
			}

			// Get the relative class name.
			$relative_class = substr( $class, $length );

			/*
			 * Add the base directory, replace namespace separators with directory
			 * separators in the relative class name and append with .php.
			 */
			$file = $base_dir . str_replace( '\\', $sep, $relative_class ) . '.php';

			// If the file exists, require it.
			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}

		public function admin_enqueue_scripts() {
			$suffix = ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' );
			wp_enqueue_style( 'cmb2_grid_bootstrap_light', $this->url( 'assets/css/bootstrap' . $suffix . '.css' ), null, self::VERSION );
		}

		public function wpHead() {
			?>
			<style>
				.cmb2GridRow .cmb-row{border:none !important;padding:0 !important}
				.cmb2GridRow .cmb-th label:after{border:none !important}
				.cmb2GridRow .cmb-th{width:100% !important}
				.cmb2GridRow .cmb-td{width:100% !important}
				.cmb2GridRow input[type="text"], .cmb2GridRow textarea, .cmb2GridRow select{width:100%}

				.cmb2GridRow .cmb-repeat-group-wrap{max-width:100% !important;}
				.cmb2GridRow .cmb-group-title{margin:0 !important;}
				.cmb2GridRow .cmb-repeat-group-wrap .cmb-row .cmbhandle, .cmb2GridRow .postbox-container .cmb-row .cmbhandle{right:0 !important}
			</style>
			<?php

		}

		// Based on CMB2_Utils url() method.
		public function url( $path = '' ) {
			if ( isset( $this->url ) ) {
				return $this->url . $path;
			}

			if ( 'WIN' === strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
				// Windows
				$content_dir = str_replace( '/', DIRECTORY_SEPARATOR, WP_CONTENT_DIR );
				$content_url = str_replace( $content_dir, WP_CONTENT_URL, CMB2GRID_DIR );
				$cmb2_url	 = str_replace( DIRECTORY_SEPARATOR, '/', $content_url );
			} else {
				$cmb2_url = str_replace(
					array( WP_CONTENT_DIR, WP_PLUGIN_DIR ),
					array( WP_CONTENT_URL, WP_PLUGIN_URL ),
					CMB2GRID_DIR
				);
			}

			/**
			 * Filter the CMB location url.
			 *
			 * @param string $cmb2_url Currently registered url.
			 */
			$this->url = trailingslashit( apply_filters( 'cmb2_meta_box_url', set_url_scheme( $cmb2_url ), CMB2_VERSION ) );

			return $this->url . $path;
		}
	}
}


/* Instantiate the class on plugins_loaded. */
// wp_installing() function was introduced in WP 4.4.
if ( ( function_exists( 'wp_installing' ) && wp_installing() === false ) || ( ! function_exists( 'wp_installing' ) && ( ! defined( 'WP_INSTALLING' ) || WP_INSTALLING === false ) ) ) {
	add_action( 'plugins_loaded', '\\' . __NAMESPACE__ . '\init' );
}

if ( ! function_exists( '\Cmb2Grid\init' ) ) {
	/**
	 * Initialize the class only if CMB2 is detected.
	 *
	 * @return void
	 */
	function init() {
		if ( defined( 'CMB2_LOADED' ) ) {
			if ( ! defined( 'CMB2GRID_DIR' ) ) {
				define( 'CMB2GRID_DIR', trailingslashit( dirname( __FILE__ ) ) );
			}
			Cmb2GridPlugin::getInstance();
		}
	}
}

