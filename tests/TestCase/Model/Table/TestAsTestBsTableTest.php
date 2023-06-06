<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestAsTestBsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestAsTestBsTable Test Case
 */
class TestAsTestBsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TestAsTestBsTable
     */
    protected $TestAsTestBs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TestAsTestBs',
        'app.TestAs',
        'app.TestBs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TestAsTestBs') ? [] : ['className' => TestAsTestBsTable::class];
        $this->TestAsTestBs = $this->getTableLocator()->get('TestAsTestBs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TestAsTestBs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TestAsTestBsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TestAsTestBsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
