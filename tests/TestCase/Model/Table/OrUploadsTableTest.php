<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrUploadsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrUploadsTable Test Case
 */
class OrUploadsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrUploadsTable
     */
    protected $OrUploads;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OrUploads',
        'app.OrderReqs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrUploads') ? [] : ['className' => OrUploadsTable::class];
        $this->OrUploads = $this->getTableLocator()->get('OrUploads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrUploads);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrUploadsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrUploadsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
