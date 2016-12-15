<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cmb2Grid\Grid\Group;

if ( ! class_exists( '\Cmb2Grid\Grid\Group\GroupRow' ) ) {

	/**
	 * Description of GroupRow.
	 *
	 * @author Pablo
	 */
	class GroupRow extends \Cmb2Grid\Grid\Row {

		protected $parentFieldId;

		/* protected function openRow( \CMB2_Field $field ) {
		  //error_log( print_r( $field, true ) );
		  //$fieldID = $field[1];

		  //@$field->args['fields'][ $fieldID ]['before_row'] .= "<div class=\"{$columnClass}\">";
		  //@$field->args['fields'][ $fieldID ]['after_row']  .= '</div>';

		  //\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'before_row' );
		  @$field->args['fields'][ $fieldID ]['before_row'] .= '<div class="row cmb2GridRow">';
		  }

		  protected function closeRow( \CMB2_Field $field ) {
		  //error_log( print_r( $field, true ) );


		  \Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'after_row' );
		  $field->args['after_row'].= '</div>';
		  } */

		protected function closeGroupRow( \CMB2_Field $field, $fieldID ) {
			if ( !empty( $fieldID['after_row'] ) ) {
				@$field->args['fields'][ $fieldID ]['after_row'] .= '</div>';
			}
		}

		protected function openGroupRow( \CMB2_Field $field, $fieldID ) {
			if ( !empty( $fieldID['before_row'] ) ) {
				@$field->args['fields'][ $fieldID ]['before_row'] .= '<div class="row cmb2GridRow">';
			}
		}

		protected function handleRow() {
			$columns = $this->getColumns();

			/* @var $firstColumn GroupColumn */
			$firstColumn = $columns[0];
			$field		 = $firstColumn->getField();
			$fieldID	 = $firstColumn->getFieldId();
			$this->openGroupRow( $field, $fieldID );

			$lastColumn	 = $columns[ ( count( $columns ) - 1 ) ];
			$field		 = $lastColumn->getField();
			$fieldID	 = $lastColumn->getFieldId();
			$this->closeGroupRow( $field, $fieldID );
		}

		protected function addColumn( $field ) {
			//parent::addColumn( $field );
			$column		 = new GroupColumn( $field, $this->getGrid() );
			$columns	 = $this->getColumns();
			$columns[]	 = $column;
			$this->setColumns( $columns );
			return $column;
		}

		public function addColumns( array $fields = array() ) {
			//parent::addColumns($fields);
			foreach ( $fields as $key => $field ) {
				$this->addColumn( $field );
			}
			//$this->handleColumnsCssClasses();
			$this->handleRow();
			$this->handleColumnsCssClasses();
		}

		function getParentFieldId() {
			return $this->parentFieldId;
		}

		function setParentFieldId( $parentFieldId ) {
			$this->parentFieldId = $parentFieldId;
		}
	}
}
