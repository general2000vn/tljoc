<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcStatusesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcStatusesTable Test Case
 */
class AcStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcStatusesTable
     */
    protected $AcStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AcStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AcStatuses') ? [] : ['className' => AcStatusesTable::class];
        $this->AcStatuses = $this->getTableLocator()->get('AcStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AcStatuses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AcStatusesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
