<?php

namespace Cmb2Grid\Grid;

/**
 * Description of Cmb2GridColumn
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
class Column {

	private $field;
	private $fieldId;
	private $grid;
	private $columnClassWidth;

	public function __construct( $fieldId, Cmb2Grid $grid ) {
		$this->setGrid($grid);
		$this->setFieldId($fieldId);		
		$field = cmb2_get_field($grid->getCmb2Obj(), $fieldId);
		$this->setField($field);
	}
	
	function getColumnClassWidth() {
		return $this->columnClassWidth;
	}

	function setColumnClassWidth( $columnClassNum ) {
		$this->columnClassWidth = $columnClassNum;
		$field = $this->getField();
		\Cmb2Grid\Cmb2\Utils::initializeFieldArg($field, 'before_row');
		\Cmb2Grid\Cmb2\Utils::initializeFieldArg($field, 'after_row');
		$field->args['before_row'].="<div class='col-md-{$columnClassNum}'>";
		$field->args['after_row'].="</div>";
	}
	
	function getField() {
		return $this->field;
	}

	/**
	 * 
	 * @return CMB2_Field
	 */
	function getFieldId() {
		return $this->fieldId;
	}

	function setField( $field ) {
		$this->field = $field;
	}

	function setFieldId( $fieldId ) {
		$this->fieldId = $fieldId;
	}

	/**
	 * 
	 * @return Cmb2Grid
	 */
	function getGrid() {
		return $this->grid;
	}

	function setGrid( $grid ) {
		$this->grid = $grid;
	}

}
