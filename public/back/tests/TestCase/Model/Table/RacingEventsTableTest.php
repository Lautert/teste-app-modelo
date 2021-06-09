<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RacingEventsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RacingEventsTable Test Case
 */
class RacingEventsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RacingEventsTable
     */
    protected $RacingEvents;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RacingEvents',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RacingEvents') ? [] : ['className' => RacingEventsTable::class];
        $this->RacingEvents = $this->getTableLocator()->get('RacingEvents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RacingEvents);

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
