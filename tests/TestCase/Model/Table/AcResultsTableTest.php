<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcResultsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcResultsTable Test Case
 */
class AcResultsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcResultsTable
     */
    protected $AcResults;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AcResults',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AcResults') ? [] : ['className' => AcResultsTable::class];
        $this->AcResults = $this->getTableLocator()->get('AcResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AcResults);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AcResultsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
