<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocInDeptsDocIncomingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocInDeptsDocIncomingsTable Test Case
 */
class DocInDeptsDocIncomingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocInDeptsDocIncomingsTable
     */
    protected $DocInDeptsDocIncomings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocInDeptsDocIncomings',
        'app.DocInDepts',
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
        $config = $this->getTableLocator()->exists('DocInDeptsDocIncomings') ? [] : ['className' => DocInDeptsDocIncomingsTable::class];
        $this->DocInDeptsDocIncomings = $this->getTableLocator()->get('DocInDeptsDocIncomings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocInDeptsDocIncomings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocInDeptsDocIncomingsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DocInDeptsDocIncomingsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
