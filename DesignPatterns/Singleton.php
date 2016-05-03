<?php
namespace Cmb2Grid\DesignPatterns;
/**
 * Description of Singleton.
 *
 * Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
if ( ! class_exists( '\Cmb2Grid\DesignPatterns\Singleton' ) ) {

	abstract class Singleton {

		abstract protected function __construct();

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @staticvar Singleton $instance The *Singleton* instances of this class.
		 *
		 * @return Current_Class_Name
		 */
		public static function getInstance() {
			static $instance = null;
			if ( null === $instance ) {
				$instance = new static();
			}

			return $instance;
		}

		final private function __clone() {
		}
	}
}
