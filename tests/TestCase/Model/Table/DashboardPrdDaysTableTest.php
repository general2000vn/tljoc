<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DashboardPrdDaysTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DashboardPrdDaysTable Test Case
 */
class DashboardPrdDaysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DashboardPrdDaysTable
     */
    protected $DashboardPrdDays;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DashboardPrdDays',
        'app.OilFields',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DashboardPrdDays') ? [] : ['className' => DashboardPrdDaysTable::class];
        $this->DashboardPrdDays = $this->getTableLocator()->get('DashboardPrdDays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DashboardPrdDays);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DashboardPrdDaysTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DashboardPrdDaysTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
