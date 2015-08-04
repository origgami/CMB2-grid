<?php

namespace Cmb2Grid;

/*
  Plugin Name: CMB2 Grid
  Plugin URI: https://github.com/origgami/CMB2-grid
  Description: A grid system for Wordpress CMB2 library that allows columns creation
  Version: 1.0.0
  Author: Origgami
  Author URI: http://origgami.com.br
  License: GPLv2
 */

class Cmb2GridPlugin {

	public function __construct() {
		$this->loadFiles();
		add_action('admin_head', array($this, 'wpHead'));
		add_action('admin_enqueue_scripts',array($this,'admin_enqueue_scripts'));
		//$this->test();
	}
	
	private function test(){
		require dirname(__FILE__).'/Test/Test.php';
		new Test\Test();
	}
	
	private function loadFiles(){
		if(is_admin()){
			require dirname(__FILE__).'/Grid/Cmb2Grid.php';
			require dirname(__FILE__).'/Grid/Column.php';
			require dirname(__FILE__).'/Grid/Row.php';
			require dirname(__FILE__).'/Cmb2/Utils.php';
		}
	}
	
	public function admin_enqueue_scripts() {
		wp_enqueue_style('bootstrap_light', plugins_url('assets/css/bootstrap.min.css', __FILE__));
	}

	public function wpHead() {
		?>
		<style>			
			.cmb2GridRow .cmb-row{border:none !important;padding:0 !important}
			.cmb2GridRow .cmb-th label:after{border:none !important}
			.cmb2GridRow .cmb-th{width:100% !important}
			.cmb2GridRow .cmb-td{width:100% !important}
			.cmb2GridRow input.regular-text{width:100%}
		</style>
		<?php
	}


}

new Cmb2GridPlugin();
