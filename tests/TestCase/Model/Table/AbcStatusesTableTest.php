<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbcStatusesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbcStatusesTable Test Case
 */
class AbcStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AbcStatusesTable
     */
    protected $AbcStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AbcStatuses',
        'app.AbcCampaigns',
        'app.AbcForms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AbcStatuses') ? [] : ['className' => AbcStatusesTable::class];
        $this->AbcStatuses = $this->getTableLocator()->get('AbcStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AbcStatuses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AbcStatusesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
