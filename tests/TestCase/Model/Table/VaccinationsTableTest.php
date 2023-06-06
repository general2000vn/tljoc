<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VaccinationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VaccinationsTable Test Case
 */
class VaccinationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VaccinationsTable
     */
    protected $Vaccinations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Vaccinations',
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
        $config = $this->getTableLocator()->exists('Vaccinations') ? [] : ['className' => VaccinationsTable::class];
        $this->Vaccinations = $this->getTableLocator()->get('Vaccinations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Vaccinations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VaccinationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
