<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailQueueTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailQueueTable Test Case
 */
class EmailQueueTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailQueueTable
     */
    protected $EmailQueue;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.EmailQueue',
        'app.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('EmailQueue') ? [] : ['className' => EmailQueueTable::class];
        $this->EmailQueue = $this->getTableLocator()->get('EmailQueue', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EmailQueue);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EmailQueueTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
