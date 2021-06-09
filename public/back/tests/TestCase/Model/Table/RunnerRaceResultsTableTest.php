<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RunnerRaceResultsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RunnerRaceResultsTable Test Case
 */
class RunnerRaceResultsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RunnerRaceResultsTable
     */
    protected $RunnerRaceResults;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RunnerRaceResults',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RunnerRaceResults') ? [] : ['className' => RunnerRaceResultsTable::class];
        $this->RunnerRaceResults = $this->getTableLocator()->get('RunnerRaceResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RunnerRaceResults);

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
