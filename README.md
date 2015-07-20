# CMB2-grid
A grid system for Wordpress CMB2 library that allows the creation of columns for a better layout in the admin.

## Usage
Create your cmb2 metabox like you always do:

```php
$cmb = new_cmb2_box(array(
	'id'			 => $prefix . 'metabox',
	'title'			 => __('Test Metabox', 'cmb2'),
	'object_types'	 => array('page',), // Post type
));

$field1 = $cmb->add_field(array(
	'name'		 => __('Test Text', 'cmb2'),
	'desc'		 => __('field description (optional)', 'cmb2'),
	'id'		 => $prefix . 'text',
	'type'		 => 'text',
));

$field2 = $cmb->add_field(array(
	'name'		 => __('Test Text2', 'cmb2'),
	'desc'		 => __('field description2 (optional2)', 'cmb2'),
	'id'		 => $prefix . 'text2',
	'type'		 => 'text',
));
```
Now, create your columns like this:

```php
$cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid($cmb);
$row = $cmb2Grid->addRow();
$row->addColumns(array($field1, $field2));
```

**OBS**
- If you want, you can opt to use the metabox and the field IDs also.
- Currently the grid system is using a lite version of Twitter Bootstrap
- You can create as much rows as you want
- You have to put the fields in the columns in the same order they were created

## Screenshots

**This is what you get using columns**

![Image](assets/imgs/screenshot1.png?raw=true)







