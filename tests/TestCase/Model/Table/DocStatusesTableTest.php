<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocStatusesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocStatusesTable Test Case
 */
class DocStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocStatusesTable
     */
    protected $DocStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('DocStatuses') ? [] : ['className' => DocStatusesTable::class];
        $this->DocStatuses = $this->getTableLocator()->get('DocStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocStatuses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocStatusesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
