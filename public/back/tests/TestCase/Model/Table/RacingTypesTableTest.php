<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RacingTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RacingTypesTable Test Case
 */
class RacingTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RacingTypesTable
     */
    protected $RacingTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RacingTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RacingTypes') ? [] : ['className' => RacingTypesTable::class];
        $this->RacingTypes = $this->getTableLocator()->get('RacingTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RacingTypes);

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
