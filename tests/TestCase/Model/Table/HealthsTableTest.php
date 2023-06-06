<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HealthsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HealthsTable Test Case
 */
class HealthsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HealthsTable
     */
    protected $Healths;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Healths',
        'app.Timesheets',
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
        $config = $this->getTableLocator()->exists('Healths') ? [] : ['className' => HealthsTable::class];
        $this->Healths = $this->getTableLocator()->get('Healths', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Healths);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HealthsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
