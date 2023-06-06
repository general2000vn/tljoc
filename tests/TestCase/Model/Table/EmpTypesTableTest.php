<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmpTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmpTypesTable Test Case
 */
class EmpTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmpTypesTable
     */
    protected $EmpTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.EmpTypes',
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
        $config = $this->getTableLocator()->exists('EmpTypes') ? [] : ['className' => EmpTypesTable::class];
        $this->EmpTypes = $this->getTableLocator()->get('EmpTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EmpTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EmpTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
