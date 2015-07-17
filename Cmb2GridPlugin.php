<?php

namespace Cmb2Grid;

/*
  Plugin Name: CMB2 Grid
  Plugin URI: https://github.com/origgami/CMB2-grid
  Description: A grid system for Wordpress CMB2 library that allows columns creation
  Version: 1.0.0
  Author: Pablo Pacheco <pablo.pacheco@origgami.com.br>
  Author URI: http://origgami.com.br
  License: GPLv2
 */

class Cmb2GridPlugin {

	public function __construct() {
		$this->loadFiles();
		add_action('admin_head', array($this, 'wpHead'));
		add_action('admin_enqueue_scripts',array($this,'admin_enqueue_scripts'));
		$this->test();
	}
	
	private function test(){
		$cmb2Grid = new Grid\Cmb2Grid();
		$row = $cmb2Grid->addRow();
	}
	
	private function loadFiles(){
		if(is_admin()){
			require dirname(__FILE__).'/Grid/Cmb2Grid.php';
			require dirname(__FILE__).'/Grid/Cmb2GridColumn.php';
			require dirname(__FILE__).'/Grid/Cmb2GridRow.php';
		}
	}
	
	public function admin_enqueue_scripts() {
		//wp_enqueue_style('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap_light', plugins_url('assets/css/bootstrap.min.css', __FILE__));
	}

	public function wpHead() {
		?>
		<style>
			.cmb-row.cmb-type-checkbox .cmb-th{display:inline-block;}
			.cmb-row.cmb-type-checkbox .cmb-td{display:inline-block;}
			.cmb-row.cmb-type-checkbox .cmb-td input{margin:0px 0 0 5px;padding:0;}			
			.cmb-row.cmb-type-checkbox *{vertical-align:middle}
			.cmb2-metabox-description{color:#aaa;margin:0}
		</style>
		<?php
	}


}

new Cmb2GridPlugin();
