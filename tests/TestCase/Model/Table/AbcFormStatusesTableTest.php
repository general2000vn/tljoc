<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbcFormStatusesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbcFormStatusesTable Test Case
 */
class AbcFormStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AbcFormStatusesTable
     */
    protected $AbcFormStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AbcFormStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AbcFormStatuses') ? [] : ['className' => AbcFormStatusesTable::class];
        $this->AbcFormStatuses = $this->getTableLocator()->get('AbcFormStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AbcFormStatuses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AbcFormStatusesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
