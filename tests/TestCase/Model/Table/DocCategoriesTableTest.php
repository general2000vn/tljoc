<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocCategoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocCategoriesTable Test Case
 */
class DocCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocCategoriesTable
     */
    protected $DocCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocCategories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocCategories') ? [] : ['className' => DocCategoriesTable::class];
        $this->DocCategories = $this->getTableLocator()->get('DocCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocCategories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocCategoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
