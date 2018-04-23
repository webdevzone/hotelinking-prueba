<?php
/**
 * User Fixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false, 'key' => 'primary'),
		'user_role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'title_before' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'middle_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'title_after' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'agree_tos' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'activation_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'activation_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'image' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'timezone' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'forgotpassword_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 120, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'ip_created' => array('type' => 'string', 'null' => false, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'is_active' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'is_deleted' => array('type' => 'tinyinteger', 'null' => false, 'default' => '0', 'unsigned' => false),
		'status' => array('type' => 'smallinteger', 'null' => false, 'default' => '0', 'length' => 5, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'activation_key' => array('column' => 'activation_key', 'unique' => 0),
			'forgotpassword_key' => array('column' => 'forgotpassword_key', 'unique' => 0),
			'email' => array('column' => 'email', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_role_id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'title_before' => 'Lorem ipsum dolor ',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'middle_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'title_after' => 'Lorem ipsum dolor ',
			'agree_tos' => 1,
			'activation_key' => 'Lorem ipsum dolor sit amet',
			'activation_date' => '2018-04-23 12:59:39',
			'image' => 'Lorem ipsum dolor sit amet',
			'timezone' => 'Lorem ip',
			'forgotpassword_key' => 'Lorem ipsum dolor sit amet',
			'ip_created' => 'Lorem ip',
			'is_active' => 1,
			'is_deleted' => 1,
			'status' => 1,
			'modified' => '2018-04-23 12:59:39',
			'created' => '2018-04-23 12:59:39'
		),
	);

}
