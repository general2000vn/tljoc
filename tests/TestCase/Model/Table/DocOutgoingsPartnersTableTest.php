<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocOutgoingsPartnersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocOutgoingsPartnersTable Test Case
 */
class DocOutgoingsPartnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocOutgoingsPartnersTable
     */
    protected $DocOutgoingsPartners;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocOutgoingsPartners',
        'app.DocOutgoings',
        'app.Partners',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocOutgoingsPartners') ? [] : ['className' => DocOutgoingsPartnersTable::class];
        $this->DocOutgoingsPartners = $this->getTableLocator()->get('DocOutgoingsPartners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocOutgoingsPartners);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocOutgoingsPartnersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DocOutgoingsPartnersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
