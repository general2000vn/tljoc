<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderReqsPartnersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderReqsPartnersTable Test Case
 */
class OrderReqsPartnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderReqsPartnersTable
     */
    protected $OrderReqsPartners;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OrderReqsPartners',
        'app.OrderReqs',
        'app.Partners',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderReqsPartners') ? [] : ['className' => OrderReqsPartnersTable::class];
        $this->OrderReqsPartners = $this->getTableLocator()->get('OrderReqsPartners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrderReqsPartners);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrderReqsPartnersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrderReqsPartnersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
