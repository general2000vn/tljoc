<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HseStatsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HseStatsTable Test Case
 */
class HseStatsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HseStatsTable
     */
    protected $HseStats;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HseStats',
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
        $config = $this->getTableLocator()->exists('HseStats') ? [] : ['className' => HseStatsTable::class];
        $this->HseStats = $this->getTableLocator()->get('HseStats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HseStats);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HseStatsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\HseStatsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
