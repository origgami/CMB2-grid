<?php
namespace Cmb2Grid\Cmb2;
/**
 * Description of Utils.
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
if ( ! class_exists( '\Cmb2Grid\Cmb2\Utils' ) ) {
	class Utils {

		public static function initializeFieldArg( \CMB2_Field $field, $arg ) {
			if ( ! isset( $field->args[ $arg ] ) ) {
				$field->args[ $arg ] = '';
			}
			return $field;
		}

		public static function initializeGroupFieldArg( \CMB2_Field $field, $arg ) {
			if ( ! isset( $field[ $arg ] ) ) {
				$field[ $arg ] = '';
			}
			return $field;
		}
	}
}
