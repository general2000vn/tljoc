<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeliAddressesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeliAddressesTable Test Case
 */
class DeliAddressesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DeliAddressesTable
     */
    protected $DeliAddresses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DeliAddresses',
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
        $config = $this->getTableLocator()->exists('DeliAddresses') ? [] : ['className' => DeliAddressesTable::class];
        $this->DeliAddresses = $this->getTableLocator()->get('DeliAddresses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DeliAddresses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DeliAddressesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
