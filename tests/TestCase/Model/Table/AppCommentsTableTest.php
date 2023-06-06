<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppCommentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppCommentsTable Test Case
 */
class AppCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AppCommentsTable
     */
    protected $AppComments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AppComments',
        'app.Users',
        'app.AcTypes',
        'app.AcResults',
        'app.AcStatuses',
        'app.AcModules',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AppComments') ? [] : ['className' => AppCommentsTable::class];
        $this->AppComments = $this->getTableLocator()->get('AppComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AppComments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AppCommentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AppCommentsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
