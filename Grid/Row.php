<?php

namespace Cmb2Grid\Grid;

/**
 * Description of Cmb2GridRow.
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */

if ( ! class_exists( '\Cmb2Grid\Grid\Row' ) ) {
	class Row {

		private $grid;
		private $columns = array();

		public function __construct( Cmb2Grid $grid ) {
			$this->setGrid( $grid );
		}

		protected function openRow( \CMB2_Field $field ) {
			//error_log( print_r( $field, true ) );

			if ( $field->args['type'] === 'group' ) {
				\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'before_group' );
				$field->args['before_group'] .= '<div class="row cmb2GridRow">';
			} else {
				\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'before_row' );
				$field->args['before_row'] .= '<div class="row cmb2GridRow">';
			}
		}

		protected function closeRow( \CMB2_Field $field ) {
			//error_log( print_r( $field, true ) );

			if ( $field->args['type'] === 'group' ) {
				\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'after_group' );
				$field->args['after_group'] .= '</div>';
			} else {
				\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'after_row' );
				$field->args['after_row'] .= '</div>';
			}
			/*\Cmb2Grid\Cmb2\Utils::initializeFieldArg( $field, 'after_row' );
			$field->args['after_row'].= '</div>';*/
		}

		protected function handleRow() {
			$columns = $this->getColumns();

			/* @var $firstColumn Column */
			$firstColumn = $columns[0];
			$field       = $firstColumn->getField();
			$this->openRow( $field );

			$lastColumn = $columns[ ( count( $columns ) - 1 ) ];
			$field      = $lastColumn->getField();
			$this->closeRow( $field );
		}

		public function addColumns( array $fields = array() ) {
			foreach ( $fields as $key => $field ) {
				$this->addColumn( $field );
			}
			$this->handleRow();
			$this->handleColumnsCssClasses();
		}

		protected function handleColumnsCssClasses() {
			$columns      = $this->getColumns();
			$columnsCount = count( $columns );
			$columnWidth  = round( 12 / $columnsCount );
			/*@var $column Column*/
			foreach ( $columns as $key => $column ) {
				if ( ! $column->getColumnClass() ) {
					$column->setBootstrapColumnClass( $columnWidth );
				} else {
					$column->setColumnClassCmb2();
				}
			}
		}

		protected function addColumn( $field ) {
			$column    = new Column( $field,$this->getGrid() );
			$columns   = $this->getColumns();
			$columns[] = $column;
			$this->setColumns( $columns );
			return $column;
		}

		/*protected function handleRow( $column ) {

		}*/

		function getGrid() {
			return $this->grid;
		}

		function setGrid( $grid ) {
			$this->grid = $grid;
		}

		function getColumns() {
			return $this->columns;
		}

		function setColumns( $columns ) {
			$this->columns = $columns;
		}
	}
}
