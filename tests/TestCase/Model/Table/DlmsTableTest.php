<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DlmsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DlmsTable Test Case
 */
class DlmsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DlmsTable
     */
    protected $Dlms;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Dlms',
        'app.Departments',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Dlms') ? [] : ['className' => DlmsTable::class];
        $this->Dlms = $this->getTableLocator()->get('Dlms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Dlms);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DlmsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DlmsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
