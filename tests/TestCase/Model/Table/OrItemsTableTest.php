<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrItemsTable Test Case
 */
class OrItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrItemsTable
     */
    protected $OrItems;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OrItems',
        'app.OrderReqs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrItems') ? [] : ['className' => OrItemsTable::class];
        $this->OrItems = $this->getTableLocator()->get('OrItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrItems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrItemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
