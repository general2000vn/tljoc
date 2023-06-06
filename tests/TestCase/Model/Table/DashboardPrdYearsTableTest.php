<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DashboardPrdYearsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DashboardPrdYearsTable Test Case
 */
class DashboardPrdYearsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DashboardPrdYearsTable
     */
    protected $DashboardPrdYears;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DashboardPrdYears',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DashboardPrdYears') ? [] : ['className' => DashboardPrdYearsTable::class];
        $this->DashboardPrdYears = $this->getTableLocator()->get('DashboardPrdYears', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DashboardPrdYears);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DashboardPrdYearsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
