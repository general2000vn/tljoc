<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HrPTaskStatusesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HrPTaskStatusesTable Test Case
 */
class HrPTaskStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HrPTaskStatusesTable
     */
    protected $HrPTaskStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HrPTaskStatuses',
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
        $config = $this->getTableLocator()->exists('HrPTaskStatuses') ? [] : ['className' => HrPTaskStatusesTable::class];
        $this->HrPTaskStatuses = $this->getTableLocator()->get('HrPTaskStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HrPTaskStatuses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HrPTaskStatusesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
