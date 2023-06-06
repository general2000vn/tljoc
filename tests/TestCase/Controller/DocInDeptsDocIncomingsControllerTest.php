<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\DocInDeptsDocIncomingsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\DocInDeptsDocIncomingsController Test Case
 *
 * @uses \App\Controller\DocInDeptsDocIncomingsController
 */
class DocInDeptsDocIncomingsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocInDeptsDocIncomings',
        'app.Departments',
        'app.DocIncomings',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\DocInDeptsDocIncomingsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\DocInDeptsDocIncomingsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\DocInDeptsDocIncomingsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\DocInDeptsDocIncomingsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\DocInDeptsDocIncomingsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
