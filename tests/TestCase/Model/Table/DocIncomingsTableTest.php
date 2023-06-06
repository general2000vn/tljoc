<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocIncomingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocIncomingsTable Test Case
 */
class DocIncomingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocIncomingsTable
     */
    protected $DocIncomings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocIncomings',
        'app.DocCompanies',
        'app.Partners',
        'app.Inputters',
        'app.DocMethods',
        'app.DocStatuses',
        'app.DocTypes',
        'app.DocInDepts',
        'app.Modifiers',
        'app.DocSecLevels',
        'app.DocOutgoings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocIncomings') ? [] : ['className' => DocIncomingsTable::class];
        $this->DocIncomings = $this->getTableLocator()->get('DocIncomings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocIncomings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocIncomingsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DocIncomingsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveNewDoc method
     *
     * @return void
     * @uses \App\Model\Table\DocIncomingsTable::saveNewDoc()
     */
    public function testSaveNewDoc(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveEditedDoc method
     *
     * @return void
     * @uses \App\Model\Table\DocIncomingsTable::saveEditedDoc()
     */
    public function testSaveEditedDoc(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAJAX method
     *
     * @return void
     * @uses \App\Model\Table\DocIncomingsTable::findAJAX()
     */
    public function testFindAJAX(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
