<?php
App::uses('BookCategory', 'Model');

/**
 * BookCategory Test Case
 *
 */
class BookCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.book_category',
		'app.book',
		'app.author',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BookCategory = ClassRegistry::init('BookCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BookCategory);

		parent::tearDown();
	}

}
