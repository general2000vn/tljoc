<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcTypesTable Test Case
 */
class AcTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcTypesTable
     */
    protected $AcTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AcTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AcTypes') ? [] : ['className' => AcTypesTable::class];
        $this->AcTypes = $this->getTableLocator()->get('AcTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AcTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AcTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
