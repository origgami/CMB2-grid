<?php

namespace Cmb2Grid\Grid;

/**
 * Description of Cmb2GridColumn.
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
if ( ! class_exists( '\Cmb2Grid\Grid\Column' ) ) {

	class Column {

		private $field;
		private $fieldId;
		private $grid;
		private $columnClassWidth;
		private $columnClass;

		public function __construct( $field, Cmb2Grid $grid ) {
			$this->setGrid( $grid );
			if ( is_string( $field ) ) {
				$this->setFieldId( $field );
			} elseif ( is_array( $field ) ) {
				$this->setFieldId( $field[0] );
			} elseif ( is_a( $field, '\Cmb2Grid\Grid\Group\Cmb2GroupGrid' ) ) {
				$this->setFieldId( $field->getParentFieldId() );
			}
			$fieldId = $this->getFieldId();


			$finalField = cmb2_get_field( $grid->getCmb2Obj(), $fieldId );

			$this->setField( $finalField );

			if ( is_array( $field ) ) {
				if ( isset( $field['class'] ) ) {
					$this->setColumnClass( $field['class'] );
				}
			}
		}

		function getColumnClassWidth() {
			return $this->columnClassWidth;
		}

		public function setColumnClassCmb2() {
			$columnClass = $this->getColumnClass();
			$field		 = $this->getField();
			//error_log( print_r( $field, true ) );


			if ( $field->args['type'] === 'group' ) {
				\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'before_group' );
				\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'after_group' );
				$field->args['before_group'] .= "<div class=\"{$columnClass}\">";
				$field->args['after_group']  .= '</div>';
			} else {
				\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'before_row' );
				\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'after_row' );
				$field->args['before_row'] .= "<div class=\"{$columnClass}\">";
				$field->args['after_row']  .= '</div>';
			}

		}

		function setColumnClass( $columnClass ) {
			$this->columnClass = $columnClass;
		}

		function setBootstrapColumnClass( $columnClassNum, $prefix = 'col-md' ) {
			$this->columnClassWidth = $columnClassNum;
			$this->setColumnClass( "{$prefix}-{$columnClassNum}" );
			$this->setColumnClassCmb2();
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

		function getColumnClass() {
			return $this->columnClass;
		}
	}
}
