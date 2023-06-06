<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbcCategoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbcCategoriesTable Test Case
 */
class AbcCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AbcCategoriesTable
     */
    protected $AbcCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AbcCategories',
        'app.AbcQuestions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AbcCategories') ? [] : ['className' => AbcCategoriesTable::class];
        $this->AbcCategories = $this->getTableLocator()->get('AbcCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AbcCategories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AbcCategoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
