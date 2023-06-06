<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CpMethodsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CpMethodsTable Test Case
 */
class CpMethodsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CpMethodsTable
     */
    protected $CpMethods;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.CpMethods',
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
        $config = $this->getTableLocator()->exists('CpMethods') ? [] : ['className' => CpMethodsTable::class];
        $this->CpMethods = $this->getTableLocator()->get('CpMethods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CpMethods);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CpMethodsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
