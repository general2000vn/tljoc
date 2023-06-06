<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocInternalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocInternalsTable Test Case
 */
class DocInternalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocInternalsTable
     */
    protected $DocInternals;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocInternals',
        'app.DocInternalTypes',
        'app.DocStatuses',
        'app.DocCompanies',
        'app.Departments',
        'app.Originators',
        'app.Inputters',
        'app.DocSecLevels',
        'app.Modifiers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocInternals') ? [] : ['className' => DocInternalsTable::class];
        $this->DocInternals = $this->getTableLocator()->get('DocInternals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocInternals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocInternalsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DocInternalsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveNewDoc method
     *
     * @return void
     * @uses \App\Model\Table\DocInternalsTable::saveNewDoc()
     */
    public function testSaveNewDoc(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveEditedDoc method
     *
     * @return void
     * @uses \App\Model\Table\DocInternalsTable::saveEditedDoc()
     */
    public function testSaveEditedDoc(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAJAX method
     *
     * @return void
     * @uses \App\Model\Table\DocInternalsTable::findAJAX()
     */
    public function testFindAJAX(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
