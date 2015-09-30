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
			//add_action('cmb2_init', array($this, 'testCmb'));
			add_action('cmb2_init', array($this, 'testGroupCmb'));
		}

		public function testGroupCmb() {
			// Start with an underscore to hide fields from custom fields list
			$prefix			 = '_yourprefix_group_';
			/**
			 * Repeatable Field Groups
			 */
			$cmb_group		 = new_cmb2_box(array(
				'id'			 => $prefix . 'metabox',
				'title'			 => __('Repeating Field Group', 'cmb2'),
				'object_types'	 => array('page',),
			));
			$field1	 = $cmb_group->add_field(array(
				'name'	 => __('Test Text', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'text',
				'type'	 => 'text',
			));
			$field2	 = $cmb_group->add_field(array(
				'name'	 => __('Test Text Small', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'textsmall',
				'type'	 => 'text',
			));
			
			
			// $group_field_id is the field id string, so in this case: $prefix . 'demo'
			$group_field_id	 = $cmb_group->add_field(array(
				'id'			 => $prefix . 'demo',
				'type'			 => 'group',
				//'description'	 => __('Generates reusable form entries', 'cmb2'),
				//'before_group'	 => '<div>teste</div>',
				'options'		 => array(
					'group_title'	 => __('Entry {#}', 'cmb2'), // {#} gets replaced by row number
					'add_button'	 => __('Add Another Entry', 'cmb2'),
					'remove_button'	 => __('Remove Entry', 'cmb2'),
					'sortable'		 => true, // beta
				// 'closed'     => true, // true to have the groups closed by default
				),
			));
			/**
			 * Group fields works the same, except ids only need
			 * to be unique to the group. Prefix is not needed.
			 *
			 * The parent field's id needs to be passed as the first argument.
			 */
			$cmb_group->add_group_field($group_field_id, array(
				'name'	 => __('Entry Title', 'cmb2'),
				'id'	 => 'title',
				'type'	 => 'text',
			// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			));
			$cmb_group->add_group_field($group_field_id, array(
				'name'			 => __('Description', 'cmb2'),
				'description'	 => __('Write a short description for this entry', 'cmb2'),
				'id'			 => 'description',
				'type'			 => 'textarea_small',
			));
			
			if (!is_admin()) {
				return;
			}
			$cmb2Grid	 = new \Cmb2Grid\Grid\Cmb2Grid($cmb_group);
			$row		 = $cmb2Grid->addRow();
			$row->addColumns(array(
				$field1,
				$field2,
				//array($field1, 'class' => 'col-md-8'),
				//array($field2, 'class' => 'col-md-4')
			));
			$row		 = $cmb2Grid->addRow();
			$row->addColumns(array(
				$group_field_id
				//array($field1, 'class' => 'col-md-8'),
				//array($field2, 'class' => 'col-md-4')
			));
			
		}

		public function testCmb() {
			// Start with an underscore to hide fields from custom fields list
			$prefix	 = '_yourprefix_demo_';
			/**
			 * Sample metabox to demonstrate each field type included
			 */
			$cmb	 = new_cmb2_box(array(
				'id'			 => $prefix . 'metabox',
				'title'			 => __('Test Metabox', 'cmb2'),
				'object_types'	 => array('page',), // Post type		
			));
			$field1	 = $cmb->add_field(array(
				'name'	 => __('Test Text', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'text',
				'type'	 => 'text',
			));
			$field2	 = $cmb->add_field(array(
				'name'	 => __('Test Text Small', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'textsmall',
				'type'	 => 'text',
			));
			$field3	 = $cmb->add_field(array(
				'name'	 => __('Test Text Medium', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'textmedium',
				'type'	 => 'text',
			));
			$field4	 = $cmb->add_field(array(
				'name'	 => __('Website URL', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'url',
				'type'	 => 'text',
			));
			$field5	 = $cmb->add_field(array(
				'name'	 => __('Test Text Email', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'email',
				'type'	 => 'text',
			));

			if (!is_admin()) {
				return;
			}
			$cmb2Grid	 = new \Cmb2Grid\Grid\Cmb2Grid($cmb);
			$row		 = $cmb2Grid->addRow();
			$row->addColumns(array(
				//$field1,
				//$field2
				array($field1, 'class' => 'col-md-8'),
				array($field2, 'class' => 'col-md-4')
			));
			$row		 = $cmb2Grid->addRow();
			$row->addColumns(array(
				$field3,
				$field4,
				$field5
			));
		}

	}

}