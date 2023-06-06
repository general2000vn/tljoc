<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OilPricesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OilPricesTable Test Case
 */
class OilPricesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OilPricesTable
     */
    protected $OilPrices;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OilPrices',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OilPrices') ? [] : ['className' => OilPricesTable::class];
        $this->OilPrices = $this->getTableLocator()->get('OilPrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OilPrices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OilPricesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
