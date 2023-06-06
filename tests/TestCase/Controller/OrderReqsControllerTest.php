<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\OrderReqsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\OrderReqsController Test Case
 *
 * @uses \App\Controller\OrderReqsController
 */
class OrderReqsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OrderReqs',
        'app.Departments',
        'app.Currencies',
        'app.Originators',
        'app.DeliAddresses',
        'app.SingleSources',
        'app.GroupLeaders',
        'app.DeptLeaders',
        'app.FinLeaders',
        'app.OrStatuses',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\OrderReqsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\OrderReqsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\OrderReqsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\OrderReqsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\OrderReqsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
