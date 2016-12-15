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
				$field->args['fields'][ $fieldID ]['before_row'] .= "<div class=\"{$columnClass}\">";
				$field->args['fields'][ $fieldID ]['after_row']  .= '</div>';
			}
		}

		public function __construct( $field, \Cmb2Grid\Grid\Cmb2Grid $grid ) {
			$this->setParentFieldId( $field[0] );
			$this->setFieldId( $field[1] );
			$field = cmb2_get_field( $grid->getCmb2Obj(), $this->getParentFieldId() );
			$this->setField( $field );

			//parent::__construct( $field, $grid );

			/* $this->setGrid( $grid );
			  if ( is_string( $field ) ) {
			  $this->setFieldId( $field );
			  } elseif ( is_array( $field ) ) {
			  $this->setFieldId( $field[0] );
			  }
			  $fieldId = $this->getFieldId();


			  $field = cmb2_get_field( $grid->getCmb2Obj(), $fieldId );

			  $this->setField( $field );

			  if ( is_array( $field ) ) {
			  if ( isset( $field['class'] ) ) {
			  $this->setColumnClass( $field['class'] );
			  }
			  } */
		}

		function getParentFieldId() {
			return $this->parentFieldId;
		}

		function setParentFieldId( $parentFieldId ) {
			$this->parentFieldId = $parentFieldId;
		}
	}
}
