<?php

namespace Cmb2Grid\Test;

/**
 * Description of Test.
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
if ( ! class_exists( '\Cmb2Grid\Test\Test' ) ) {

	class Test {

		public function __construct() {
			$this->addTestCmb2();
		}

		private function addTestCmb2() {
			add_action( 'cmb2_admin_init', array( $this, 'testCmb' ) );
			add_action( 'cmb2_admin_init', array( $this, 'testGroupCmb' ) );
		}

		public function testGroupCmb() {
			$prefix		 = '_yourgridprefix_group_';
			$cmb_group	 = new_cmb2_box( array(
				'id'			 => $prefix . 'metabox',
				'title'			 => __( 'Repeating Field Group using a Grid', 'cmb2' ),
				'object_types'	 => array( 'page' ),
			) );
			$field1		 = $cmb_group->add_field( array(
				'name'	 => __( 'Test Text', 'cmb2' ),
				'desc'	 => __( 'field description (optional)', 'cmb2' ),
				'id'	 => $prefix . 'text',
				'type'	 => 'text',
			) );
			$field2		 = $cmb_group->add_field( array(
				'name'	 => __( 'Test Text Small', 'cmb2' ),
				'desc'	 => __( 'field description (optional)', 'cmb2' ),
				'id'	 => $prefix . 'textsmall',
				'type'	 => 'text',
			) );

			// $group_field_id is the field id string, so in this case: $prefix . 'demo'
			$group_field_id	 = $cmb_group->add_field( array(
				'id'		 => $prefix . 'demo',
				'type'		 => 'group',
				'options'	 => array(
					'group_title'	 => __( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number.
					'add_button'	 => __( 'Add Another Entry', 'cmb2' ),
					'remove_button'	 => __( 'Remove Entry', 'cmb2' ),
					'sortable'		 => true,
				),
			) );
			$gField1		 = $cmb_group->add_group_field( $group_field_id, array(
				'name'	 => __( 'Entry Title', 'cmb2' ),
				'id'	 => 'title',
				'type'	 => 'text',
			) );
			$gField2		 = $cmb_group->add_group_field( $group_field_id, array(
				'name'			 => __( 'Description', 'cmb2' ),
				'description'	 => __( 'Write a short description for this entry', 'cmb2' ),
				'id'			 => 'description',
				'type'			 => 'textarea_small',
			));

			// Create a default grid.
			$cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid( $cmb_group );

			// Create now a Grid of group fields.
			$cmb2GroupGrid	 = $cmb2Grid->addCmb2GroupGrid( $group_field_id );
			$row			 = $cmb2GroupGrid->addRow();
			$row->addColumns( array(
				$gField1,
				$gField2,
			) );

			// Now setup your columns like you generally do, even with group fields.
			$row = $cmb2Grid->addRow();
			$row->addColumns( array(
				$field1,
				$field2,
			) );
			$row = $cmb2Grid->addRow();
			$row->addColumns( array(
				$cmb2GroupGrid, // Can be $group_field_id also.
			) );
		}

		public function testCmb() {
			// Start with an underscore to hide fields from custom fields list.
			$prefix	 = '_yourgridprefix_demo_';
			/**
			 * Sample metabox to demonstrate each field type included.
			 */
			$cmb	 = new_cmb2_box( array(
				'id'			 => $prefix . 'metabox',
				'title'			 => __( 'Test Metabox using a Grid', 'cmb2' ),
				'object_types'	 => array( 'page' ), // Post type.
			));
			$field1	 = $cmb->add_field( array(
				'name'	 => __( 'Test Text', 'cmb2' ),
				'desc'	 => __( 'field description (optional)', 'cmb2' ),
				'id'	 => $prefix . 'text',
				'type'	 => 'text',
			));
			$field2	 = $cmb->add_field( array(
				'name'	 => __( 'Test Text Small', 'cmb2' ),
				'desc'	 => __( 'field description (optional)', 'cmb2' ),
				'id'	 => $prefix . 'textsmall',
				'type'	 => 'text',
			));
			$field3	 = $cmb->add_field( array(
				'name'	 => __( 'Test Text Medium', 'cmb2' ),
				'desc'	 => __( 'field description (optional)', 'cmb2' ),
				'id'	 => $prefix . 'textmedium',
				'type'	 => 'text',
			));
			$field4	 = $cmb->add_field( array(
				'name'	 => __( 'Website URL', 'cmb2' ),
				'desc'	 => __( 'field description (optional)', 'cmb2' ),
				'id'	 => $prefix . 'url',
				'type'	 => 'text',
			));
			$field5	 = $cmb->add_field( array(
				'name'	 => __( 'Test Text Email', 'cmb2' ),
				'desc'	 => __( 'field description (optional)', 'cmb2' ),
				'id'	 => $prefix . 'email',
				'type'	 => 'text',
			));

			$cmb2Grid	 = new \Cmb2Grid\Grid\Cmb2Grid( $cmb );
			$row		 = $cmb2Grid->addRow();
			$row->addColumns( array(
				//$field1,
				//$field2
				array( $field1, 'class' => 'col-md-8' ),
				array( $field2, 'class' => 'col-md-4' ),
			));
			$row		 = $cmb2Grid->addRow();
			$row->addColumns( array(
				$field3,
				$field4,
				$field5,
			) );
		}
	}
}
