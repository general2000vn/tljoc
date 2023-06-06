<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserTitlesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserTitlesTable Test Case
 */
class UserTitlesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserTitlesTable
     */
    protected $UserTitles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UserTitles',
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
        $config = $this->getTableLocator()->exists('UserTitles') ? [] : ['className' => UserTitlesTable::class];
        $this->UserTitles = $this->getTableLocator()->get('UserTitles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserTitles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UserTitlesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
