<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RunnersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RunnersTable Test Case
 */
class RunnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RunnersTable
     */
    protected $Runners;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Runners',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Runners') ? [] : ['className' => RunnersTable::class];
        $this->Runners = $this->getTableLocator()->get('Runners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Runners);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
