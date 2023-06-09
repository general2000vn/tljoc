<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcModulesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcModulesTable Test Case
 */
class AcModulesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcModulesTable
     */
    protected $AcModules;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('AcModules') ? [] : ['className' => AcModulesTable::class];
        $this->AcModules = $this->getTableLocator()->get('AcModules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AcModules);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AcModulesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
