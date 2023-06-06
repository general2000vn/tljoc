<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CovidTestsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CovidTestsTable Test Case
 */
class CovidTestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CovidTestsTable
     */
    protected $CovidTests;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.CovidTests',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CovidTests') ? [] : ['className' => CovidTestsTable::class];
        $this->CovidTests = $this->getTableLocator()->get('CovidTests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CovidTests);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CovidTestsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CovidTestsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
