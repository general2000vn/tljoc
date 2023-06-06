<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\DocIncomingsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\DocIncomingsController Test Case
 *
 * @uses \App\Controller\DocIncomingsController
 */
class DocIncomingsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocIncomings',
        'app.DocCompanies',
        'app.Partners',
        'app.Users',
        'app.DocMethods',
        'app.DocStatuses',
        'app.DocTypes',
        'app.RelatedDocs',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\DocIncomingsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\DocIncomingsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\DocIncomingsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\DocIncomingsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\DocIncomingsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
