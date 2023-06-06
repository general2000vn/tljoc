<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HrPtTasksUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HrPtTasksUsersTable Test Case
 */
class HrPtTasksUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HrPtTasksUsersTable
     */
    protected $HrPtTasksUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HrPtTasksUsers',
        'app.Users',
        'app.HrPtTasks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('HrPtTasksUsers') ? [] : ['className' => HrPtTasksUsersTable::class];
        $this->HrPtTasksUsers = $this->getTableLocator()->get('HrPtTasksUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HrPtTasksUsers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HrPtTasksUsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\HrPtTasksUsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
