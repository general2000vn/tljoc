<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubReportsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubReportsTable Test Case
 */
class SubReportsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubReportsTable
     */
    protected $SubReports;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SubReports',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SubReports') ? [] : ['className' => SubReportsTable::class];
        $this->SubReports = $this->getTableLocator()->get('SubReports', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SubReports);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SubReportsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
