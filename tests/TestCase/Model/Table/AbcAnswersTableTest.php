<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbcAnswersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbcAnswersTable Test Case
 */
class AbcAnswersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AbcAnswersTable
     */
    protected $AbcAnswers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AbcAnswers',
        'app.AbcForms',
        'app.AbcQuestions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AbcAnswers') ? [] : ['className' => AbcAnswersTable::class];
        $this->AbcAnswers = $this->getTableLocator()->get('AbcAnswers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AbcAnswers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AbcAnswersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AbcAnswersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
