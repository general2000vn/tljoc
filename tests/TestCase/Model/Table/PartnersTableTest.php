<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartnersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartnersTable Test Case
 */
class PartnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartnersTable
     */
    protected $Partners;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Partners',
        'app.Modifiers',
        'app.DocIncomings',
        'app.DocOutgoings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Partners') ? [] : ['className' => PartnersTable::class];
        $this->Partners = $this->getTableLocator()->get('Partners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Partners);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PartnersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PartnersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAJAX method
     *
     * @return void
     * @uses \App\Model\Table\PartnersTable::findAJAX()
     */
    public function testFindAJAX(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
