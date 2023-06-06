<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocOutgoingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocOutgoingsTable Test Case
 */
class DocOutgoingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocOutgoingsTable
     */
    protected $DocOutgoings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocOutgoings',
        'app.DocTypes',
        'app.DocCompanies',
        'app.Departments',
        'app.Partners',
        'app.Originators',
        'app.Inputters',
        'app.Modifiers',
        'app.DocCategories',
        'app.DocMethods',
        'app.DocSecLevels',
        'app.DocStatuses',
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
        $config = $this->getTableLocator()->exists('DocOutgoings') ? [] : ['className' => DocOutgoingsTable::class];
        $this->DocOutgoings = $this->getTableLocator()->get('DocOutgoings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocOutgoings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocOutgoingsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DocOutgoingsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveNewDoc method
     *
     * @return void
     * @uses \App\Model\Table\DocOutgoingsTable::saveNewDoc()
     */
    public function testSaveNewDoc(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveEditedDoc method
     *
     * @return void
     * @uses \App\Model\Table\DocOutgoingsTable::saveEditedDoc()
     */
    public function testSaveEditedDoc(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAJAX method
     *
     * @return void
     * @uses \App\Model\Table\DocOutgoingsTable::findAJAX()
     */
    public function testFindAJAX(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
