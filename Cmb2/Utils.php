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

		public static function &initializeGroupFieldArg( \CMB2_Field $group_field, $fieldID, $arg ) {
            if ( isset( $group_field->args[ 'fields' ][ $fieldID ] ) ) {
                $actual_field = &$group_field->args[ 'fields' ][ $fieldID ];

                // Make sure we have SOME value in before_row
                if( !isset( $actual_field[$arg] ) ) $actual_field[$arg] = '';

                // Return the actual field
                return $actual_field;
            }
		}

        public static function appendGroupFieldArg( \CMB2_Field $group_field, $fieldID, $arg, $appendString ) {
		    // Get the actual field by reference and initialize it if needed
		    $actual_field = &self::initializeGroupFieldArg( $group_field, $fieldID, $arg );

            // Append the grid row class before row
            $actual_field[$arg] .= $appendString;
		}
	}
}
