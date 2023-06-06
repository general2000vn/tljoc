<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocSecLevelsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocSecLevelsTable Test Case
 */
class DocSecLevelsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocSecLevelsTable
     */
    protected $DocSecLevels;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocSecLevels',
        'app.DocIncomings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocSecLevels') ? [] : ['className' => DocSecLevelsTable::class];
        $this->DocSecLevels = $this->getTableLocator()->get('DocSecLevels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocSecLevels);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocSecLevelsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
