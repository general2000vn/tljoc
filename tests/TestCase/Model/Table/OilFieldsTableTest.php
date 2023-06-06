<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OilFieldsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OilFieldsTable Test Case
 */
class OilFieldsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OilFieldsTable
     */
    protected $OilFields;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OilFields',
        'app.DashboardPrdDays',
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
        $config = $this->getTableLocator()->exists('OilFields') ? [] : ['className' => OilFieldsTable::class];
        $this->OilFields = $this->getTableLocator()->get('OilFields', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OilFields);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OilFieldsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
