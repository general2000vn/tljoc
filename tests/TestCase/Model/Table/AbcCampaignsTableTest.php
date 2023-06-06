<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbcCampaignsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbcCampaignsTable Test Case
 */
class AbcCampaignsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AbcCampaignsTable
     */
    protected $AbcCampaigns;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AbcCampaigns',
        'app.Initiators',
        'app.AbcStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AbcCampaigns') ? [] : ['className' => AbcCampaignsTable::class];
        $this->AbcCampaigns = $this->getTableLocator()->get('AbcCampaigns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AbcCampaigns);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AbcCampaignsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AbcCampaignsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
