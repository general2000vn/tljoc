<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbcFormsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbcFormsTable Test Case
 */
class AbcFormsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AbcFormsTable
     */
    protected $AbcForms;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AbcForms',
        'app.Users',
        'app.AbcCanpaigns',
        'app.AbcStatuses',
        'app.AbcAnswers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AbcForms') ? [] : ['className' => AbcFormsTable::class];
        $this->AbcForms = $this->getTableLocator()->get('AbcForms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AbcForms);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AbcFormsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AbcFormsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
