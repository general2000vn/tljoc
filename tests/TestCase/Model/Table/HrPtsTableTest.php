<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HrPtsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HrPtsTable Test Case
 */
class HrPtsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HrPtsTable
     */
    protected $HrPts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HrPts',
        'app.Staffs',
        'app.Supervisors',
        'app.HrPStatuses',
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
        $config = $this->getTableLocator()->exists('HrPts') ? [] : ['className' => HrPtsTable::class];
        $this->HrPts = $this->getTableLocator()->get('HrPts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HrPts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HrPtsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\HrPtsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test notifyPIC method
     *
     * @return void
     * @uses \App\Model\Table\HrPtsTable::notifyPIC()
     */
    public function testNotifyPIC(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findNeedRemindTasks method
     *
     * @return void
     * @uses \App\Model\Table\HrPtsTable::findNeedRemindTasks()
     */
    public function testFindNeedRemindTasks(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
