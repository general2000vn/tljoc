<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentsDocIncomingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentsDocIncomingsTable Test Case
 */
class DepartmentsDocIncomingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentsDocIncomingsTable
     */
    protected $DepartmentsDocIncomings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DepartmentsDocIncomings',
        'app.Departments',
        'app.DocIncomings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DepartmentsDocIncomings') ? [] : ['className' => DepartmentsDocIncomingsTable::class];
        $this->DepartmentsDocIncomings = $this->getTableLocator()->get('DepartmentsDocIncomings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DepartmentsDocIncomings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DepartmentsDocIncomingsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DepartmentsDocIncomingsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
