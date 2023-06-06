<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestBsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestBsTable Test Case
 */
class TestBsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TestBsTable
     */
    protected $TestBs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TestBs',
        'app.TestAs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TestBs') ? [] : ['className' => TestBsTable::class];
        $this->TestBs = $this->getTableLocator()->get('TestBs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TestBs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TestBsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
