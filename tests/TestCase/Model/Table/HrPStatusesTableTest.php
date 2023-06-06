<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HrPStatusesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HrPStatusesTable Test Case
 */
class HrPStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HrPStatusesTable
     */
    protected $HrPStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HrPStatuses',
        'app.HrPts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('HrPStatuses') ? [] : ['className' => HrPStatusesTable::class];
        $this->HrPStatuses = $this->getTableLocator()->get('HrPStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HrPStatuses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HrPStatusesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
