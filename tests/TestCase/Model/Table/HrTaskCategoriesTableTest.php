<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HrTaskCategoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HrTaskCategoriesTable Test Case
 */
class HrTaskCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HrTaskCategoriesTable
     */
    protected $HrTaskCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HrTaskCategories',
        'app.HrPtTasks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('HrTaskCategories') ? [] : ['className' => HrTaskCategoriesTable::class];
        $this->HrTaskCategories = $this->getTableLocator()->get('HrTaskCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HrTaskCategories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HrTaskCategoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
