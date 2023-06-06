<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrTypesTable Test Case
 */
class OrTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrTypesTable
     */
    protected $OrTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OrTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrTypes') ? [] : ['className' => OrTypesTable::class];
        $this->OrTypes = $this->getTableLocator()->get('OrTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
