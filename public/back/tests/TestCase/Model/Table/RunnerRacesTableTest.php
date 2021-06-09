<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RunnerRacesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RunnerRacesTable Test Case
 */
class RunnerRacesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RunnerRacesTable
     */
    protected $RunnerRaces;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RunnerRaces',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RunnerRaces') ? [] : ['className' => RunnerRacesTable::class];
        $this->RunnerRaces = $this->getTableLocator()->get('RunnerRaces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RunnerRaces);

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
}
