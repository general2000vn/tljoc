<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestAsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestAsTable Test Case
 */
class TestAsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TestAsTable
     */
    protected $TestAs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('TestAs') ? [] : ['className' => TestAsTable::class];
        $this->TestAs = $this->getTableLocator()->get('TestAs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TestAs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TestAsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
