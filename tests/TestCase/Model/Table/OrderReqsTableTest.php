<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderReqsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderReqsTable Test Case
 */
class OrderReqsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderReqsTable
     */
    protected $OrderReqs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OrderReqs',
        'app.Departments',
        'app.DocCompanies',
        'app.Currencies',
        'app.Originators',
        'app.DeliAddresses',
        'app.SingleSources',
        'app.GroupLeaders',
        'app.DeptLeaders',
        'app.FinLeaders',
        'app.OrStatuses',
        'app.OrTypes',
        'app.OrItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderReqs') ? [] : ['className' => OrderReqsTable::class];
        $this->OrderReqs = $this->getTableLocator()->get('OrderReqs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrderReqs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrderReqsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrderReqsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
