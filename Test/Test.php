<?php

namespace Cmb2Grid\Test;

/**
 * Description of Test
 *
 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
 */
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
		$cmb_demo = new_cmb2_box(array(
			'id'			 => $prefix . 'metabox',
			'title'			 => __('Test Metabox', 'cmb2'),
			'object_types'	 => array('page',), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		));
		$cmb_demo->add_field(array(
			'name'		 => __('Test Text', 'cmb2'),
			'desc'		 => __('field description (optional)', 'cmb2'),
			'id'		 => $prefix . 'text',
			'type'		 => 'text',
			'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
		));
		$cmb_demo->add_field(array(
			'name'	 => __('Test Text Small', 'cmb2'),
			'desc'	 => __('field description (optional)', 'cmb2'),
			'id'	 => $prefix . 'textsmall',
			'type'	 => 'text',
		// 'repeatable' => true,
		));
		$cmb_demo->add_field(array(
			'name'	 => __('Test Text Medium', 'cmb2'),
			'desc'	 => __('field description (optional)', 'cmb2'),
			'id'	 => $prefix . 'textmedium',
			'type'	 => 'text',
		// 'repeatable' => true,
		));
		$cmb_demo->add_field(array(
			'name'	 => __('Website URL', 'cmb2'),
			'desc'	 => __('field description (optional)', 'cmb2'),
			'id'	 => $prefix . 'url',
			'type'	 => 'text',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
		));
		$cmb_demo->add_field(array(
			'name'	 => __('Test Text Email', 'cmb2'),
			'desc'	 => __('field description (optional)', 'cmb2'),
			'id'	 => $prefix . 'email',
			'type'	 => 'text',
		// 'repeatable' => true,
		));

		$this->addTestGrid();
	}

	private function addTestGrid() {
		$cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid('_yourprefix_demo_metabox');
		$row = $cmb2Grid->addRow();
		$row->addColumns(array(
			'_yourprefix_demo_text',
			'_yourprefix_demo_textsmall'
		));
		$row = $cmb2Grid->addRow();
		$row->addColumns(array(
			'_yourprefix_demo_textmedium',
			'_yourprefix_demo_url',
			'_yourprefix_demo_email'
		));
	}

}
