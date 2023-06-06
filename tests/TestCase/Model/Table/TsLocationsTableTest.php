<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TsLocationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TsLocationsTable Test Case
 */
class TsLocationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TsLocationsTable
     */
    protected $TsLocations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TsLocations',
        'app.Timesheets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TsLocations') ? [] : ['className' => TsLocationsTable::class];
        $this->TsLocations = $this->getTableLocator()->get('TsLocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TsLocations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TsLocationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
