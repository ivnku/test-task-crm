<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientsInterestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientsInterestsTable Test Case
 */
class ClientsInterestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientsInterestsTable
     */
    public $ClientsInterests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ClientsInterests',
        'app.Clients',
        'app.Interests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ClientsInterests') ? [] : ['className' => ClientsInterestsTable::class];
        $this->ClientsInterests = TableRegistry::getTableLocator()->get('ClientsInterests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientsInterests);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
