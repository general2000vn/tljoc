<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocInternalTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocInternalTypesTable Test Case
 */
class DocInternalTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocInternalTypesTable
     */
    protected $DocInternalTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocInternalTypes',
        'app.DocInternals',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocInternalTypes') ? [] : ['className' => DocInternalTypesTable::class];
        $this->DocInternalTypes = $this->getTableLocator()->get('DocInternalTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocInternalTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocInternalTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
