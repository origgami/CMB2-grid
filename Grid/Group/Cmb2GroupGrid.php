<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cmb2Grid\Grid\Group;

if ( ! class_exists( '\Cmb2Grid\Grid\Group\Cmb2GroupGrid' ) ) {

	/**
	 * Description of Cmb2GroupGrid.
	 *
	 * @author Pablo
	 */
	class Cmb2GroupGrid extends \Cmb2Grid\Grid\Cmb2Grid {

		protected $parentFieldId;

		public function addRow() {
			//parent::addRow();
			$rows	 = $this->getRows();
			$newRow	 = new GroupRow( $this );
			$newRow->setParentFieldId( $this->getParentFieldId() );
			$rows[]	 = $newRow;
			$this->setRows( $rows );
			return $newRow;
		}

		function getParentFieldId() {
			return $this->parentFieldId;
		}

		function setParentFieldId( $parentFieldId ) {
			$this->parentFieldId = $parentFieldId;
		}
	}
}
