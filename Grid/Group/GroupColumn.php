<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cmb2Grid\Grid\Group;

if ( ! class_exists( '\Cmb2Grid\Grid\Group\GroupColumn' ) ) {



	/**
	 * Description of GroupColumn.
	 *
	 * @author Pablo
	 */
	class GroupColumn extends \Cmb2Grid\Grid\Column {

		protected $parentFieldId;

		public function setColumnClassCmb2() {
			$columnClass = $this->getColumnClass();
			$field		 = $this->getField();
			$fieldID	 = $this->getFieldId();

			//\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field->args['fields'][$fieldID], 'before_row' );
			//\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field->args['fields'][$fieldID], 'after_row' );

			if ( ! empty( $fieldID['before_row'] ) && ! empty( $fieldID['after_row'] ) ) {
				$field->args['fields'][ $fieldID ]['before_row'] .= '<div class="' . esc_attr( $columnClass ) .'">';
				$field->args['fields'][ $fieldID ]['after_row']  .= '</div>';
			}
		}

		public function __construct( $field, \Cmb2Grid\Grid\Cmb2Grid $grid ) {
			$this->setParentFieldId( $field[0] );
			$this->setFieldId( $field[1] );
			$field = cmb2_get_field( $grid->getCmb2Obj(), $this->getParentFieldId() );
			$this->setField( $field );
		}

		function getParentFieldId() {
			return $this->parentFieldId;
		}

		function setParentFieldId( $parentFieldId ) {
			$this->parentFieldId = $parentFieldId;
		}
	}
}
