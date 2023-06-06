<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocCompaniesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocCompaniesTable Test Case
 */
class DocCompaniesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocCompaniesTable
     */
    protected $DocCompanies;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocCompanies',
        'app.DocIncomings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocCompanies') ? [] : ['className' => DocCompaniesTable::class];
        $this->DocCompanies = $this->getTableLocator()->get('DocCompanies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocCompanies);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocCompaniesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
