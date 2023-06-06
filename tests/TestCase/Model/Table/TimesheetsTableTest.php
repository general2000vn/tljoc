<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimesheetsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimesheetsTable Test Case
 */
class TimesheetsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TimesheetsTable
     */
    protected $Timesheets;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Timesheets',
        'app.Users',
        'app.Vaccinations',
        'app.Healths',
        'app.TsLocations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Timesheets') ? [] : ['className' => TimesheetsTable::class];
        $this->Timesheets = $this->getTableLocator()->get('Timesheets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Timesheets);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TimesheetsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TimesheetsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test hasPending method
     *
     * @return void
     * @uses \App\Model\Table\TimesheetsTable::hasPending()
     */
    public function testHasPending(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test hasTodayRecord method
     *
     * @return void
     * @uses \App\Model\Table\TimesheetsTable::hasTodayRecord()
     */
    public function testHasTodayRecord(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getTodayRecord method
     *
     * @return void
     * @uses \App\Model\Table\TimesheetsTable::getTodayRecord()
     */
    public function testGetTodayRecord(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
