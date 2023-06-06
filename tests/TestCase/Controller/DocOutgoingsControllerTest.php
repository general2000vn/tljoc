<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\DocOutgoingsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\DocOutgoingsController Test Case
 *
 * @uses \App\Controller\DocOutgoingsController
 */
class DocOutgoingsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocOutgoings',
        'app.DocTypes',
        'app.DocCompanies',
        'app.Departments',
        'app.Partners',
        'app.Originators',
        'app.Inputters',
        'app.DocCategories',
        'app.DocMethods',
        'app.DocSecLevels',
        'app.DocStatuses',
        'app.DepartmentsDocOutgoings',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
