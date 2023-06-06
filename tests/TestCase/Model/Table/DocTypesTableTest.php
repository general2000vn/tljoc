<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocTypesTable Test Case
 */
class DocTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocTypesTable
     */
    protected $DocTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocTypes',
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
        $config = $this->getTableLocator()->exists('DocTypes') ? [] : ['className' => DocTypesTable::class];
        $this->DocTypes = $this->getTableLocator()->get('DocTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
