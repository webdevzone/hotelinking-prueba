<?php
App::uses('PromotionCode', 'Model');

/**
 * PromotionCode Test Case
 */
class PromotionCodeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.promotion_code'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PromotionCode = ClassRegistry::init('PromotionCode');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PromotionCode);

		parent::tearDown();
	}

}
