<?php
namespace Cmb2Grid\Cmb2;
/**
 * Description of Utils
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
class Utils {
	//put your code here
	
	public static function initializeFieldArg(\CMB2_Field $field,$arg){
		if(!isset($field->args[$arg])){
			$field->args[$arg]='';
		}
		return $field;
	}
}
