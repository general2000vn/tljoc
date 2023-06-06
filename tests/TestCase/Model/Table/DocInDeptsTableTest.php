<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocInDeptsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocInDeptsTable Test Case
 */
class DocInDeptsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocInDeptsTable
     */
    protected $DocInDepts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocInDepts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocInDepts') ? [] : ['className' => DocInDeptsTable::class];
        $this->DocInDepts = $this->getTableLocator()->get('DocInDepts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocInDepts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocInDeptsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
