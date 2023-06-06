<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HrPtTasksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HrPtTasksTable Test Case
 */
class HrPtTasksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HrPtTasksTable
     */
    protected $HrPtTasks;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HrPtTasks',
        'app.HrPTaskStatuses',
        'app.Modifiers',
        'app.HrPts',
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
        $config = $this->getTableLocator()->exists('HrPtTasks') ? [] : ['className' => HrPtTasksTable::class];
        $this->HrPtTasks = $this->getTableLocator()->get('HrPtTasks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HrPtTasks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HrPtTasksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\HrPtTasksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test extendDeadline method
     *
     * @return void
     * @uses \App\Model\Table\HrPtTasksTable::extendDeadline()
     */
    public function testExtendDeadline(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
