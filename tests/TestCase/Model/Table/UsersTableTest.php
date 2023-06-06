<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    protected $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Users',
        'app.EmpTypes',
        'app.Groups',
        'app.Vaccinations',
        'app.Healths',
        'app.Vaccine1',
        'app.Vaccine2',
        'app.Vaccine3',
        'app.Vaccine4',
        'app.Timesheets',
        'app.CovidTests',
        'app.Roles',
        'app.HrPtTasks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = $this->getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findActive method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findActive()
     */
    public function testFindActive(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findInactive method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findInactive()
     */
    public function testFindInactive(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findEmployed method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findEmployed()
     */
    public function testFindEmployed(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findListActive method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findListActive()
     */
    public function testFindListActive(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findListAll method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findListAll()
     */
    public function testFindListAll(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findDeleted method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findDeleted()
     */
    public function testFindDeleted(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveProfile method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::saveProfile()
     */
    public function testSaveProfile(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getOneByRole method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::getOneByRole()
     */
    public function testGetOneByRole(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getAllByRole method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::getAllByRole()
     */
    public function testGetAllByRole(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test hasRole method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::hasRole()
     */
    public function testHasRole(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test hasRoleInList method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::hasRoleInList()
     */
    public function testHasRoleInList(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
