<?php

namespace Cmb2Grid\Test;

/**
 * Description of Test
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
if (!class_exists('\Cmb2Grid\Test\Test')) {
	class Test {

		public function __construct() {
			$this->addTestCmb2();
		}

		private function addTestCmb2() {
			add_action('cmb2_init', array($this, 'testCmb'));
		}

		public function testCmb() {
			// Start with an underscore to hide fields from custom fields list
			$prefix = '_yourprefix_demo_';
			/**
			 * Sample metabox to demonstrate each field type included
			 */
			$cmb = new_cmb2_box(array(
				'id'			 => $prefix . 'metabox',
				'title'			 => __('Test Metabox', 'cmb2'),
				'object_types'	 => array('page',), // Post type		
			));
			$field1 = $cmb->add_field(array(
				'name'	 => __('Test Text', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'text',
				'type'	 => 'text',
			));
			$field2 = $cmb->add_field(array(
				'name'	 => __('Test Text Small', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'textsmall',
				'type'	 => 'text',
			));
			$field3 = $cmb->add_field(array(
				'name'	 => __('Test Text Medium', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'textmedium',
				'type'	 => 'text',
			));
			$field4 = $cmb->add_field(array(
				'name'	 => __('Website URL', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'url',
				'type'	 => 'text',
			));
			$field5 = $cmb->add_field(array(
				'name'	 => __('Test Text Email', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'email',
				'type'	 => 'text',
			));

			if ( !is_admin() ) {
				return;
			}
			$cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid($cmb);
			$row = $cmb2Grid->addRow();
			$row->addColumns(array(
				//$field1,
				//$field2
				array($field1, 'class' => 'col-md-8'),
				array($field2, 'class' => 'col-md-4')
			));
			$row = $cmb2Grid->addRow();
			$row->addColumns(array(
				$field3,
				$field4,
				$field5
			));
		}

	}
}