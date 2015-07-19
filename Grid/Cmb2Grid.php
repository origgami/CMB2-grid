<?php

namespace Cmb2Grid\Grid;

/**
 * Description of Cmb2Grid
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
class Cmb2Grid {
	
	private $cmb2Obj;
	private $cmb2Id;
	private $metaBoxConfig;

	public function __construct($meta_box_config){
		$this->setMetaBoxConfig($meta_box_config);
		add_action( "admin_init", array($this,'adminInit'),99);
	}
	
	public function adminInit(){
		$this->setCmb2Obj(\cmb2_get_metabox($this->getMetaBoxConfig()));
		$cmb2Obj = $this->getCmb2Obj();
		$field = cmb2_get_field($cmb2Obj,'_yourprefix_demo_text');
		$field->args['before_row'] = '<div class="row" style="border:1px solid red;margin-top:25px">';		
	}

	public function addRow() {
		return new Row();
	}
	
	/**
	 * 
	 * @return \CMB2
	 */
	function getCmb2Obj() {
		return $this->cmb2Obj;
	}

	function setCmb2Obj( $cmb2Obj ) {
		$this->cmb2Obj = $cmb2Obj;
	}
	
	function getCmb2Id() {
		return $this->cmb2Id;
	}

	function setCmb2Id( $cmb2Id ) {
		$this->cmb2Id = $cmb2Id;
	}
	
	function getMetaBoxConfig() {
		return $this->metaBoxConfig;
	}

	function setMetaBoxConfig( $metaBoxConfig ) {
		$this->metaBoxConfig = $metaBoxConfig;
	}







}