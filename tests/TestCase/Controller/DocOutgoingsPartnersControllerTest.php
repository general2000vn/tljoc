<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\DocOutgoingsPartnersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\DocOutgoingsPartnersController Test Case
 *
 * @uses \App\Controller\DocOutgoingsPartnersController
 */
class DocOutgoingsPartnersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocOutgoingsPartners',
        'app.DocOutgoings',
        'app.Partners',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsPartnersController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsPartnersController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsPartnersController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsPartnersController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\DocOutgoingsPartnersController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
