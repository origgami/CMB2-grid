<?php

namespace Cmb2Grid\Grid;

/**
 * Description of Cmb2Grid
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
class Cmb2Grid {
	

	public function __construct() {
		
	}

	public function addRow() {
		return new Cmb2GridRow();
	}

}