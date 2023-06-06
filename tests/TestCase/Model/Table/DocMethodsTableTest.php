<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocMethodsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocMethodsTable Test Case
 */
class DocMethodsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocMethodsTable
     */
    protected $DocMethods;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocMethods',
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
        $config = $this->getTableLocator()->exists('DocMethods') ? [] : ['className' => DocMethodsTable::class];
        $this->DocMethods = $this->getTableLocator()->get('DocMethods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocMethods);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocMethodsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
