<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrCommentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrCommentsTable Test Case
 */
class OrCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrCommentsTable
     */
    protected $OrComments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OrComments',
        'app.Users',
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
        $config = $this->getTableLocator()->exists('OrComments') ? [] : ['className' => OrCommentsTable::class];
        $this->OrComments = $this->getTableLocator()->get('OrComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrComments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrCommentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrCommentsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
