<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RacingEventsFixture
 */
class RacingEventsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_racing_types' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dt_schedule' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'dt_created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'dt_modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'bl_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'racing_type_key' => ['type' => 'index', 'columns' => ['id_racing_types'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'racing_events_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_racing_types'], 'references' => ['racing_types', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'id_racing_types' => 1,
                'dt_schedule' => '2021-05-29',
                'dt_created' => '2021-05-29 13:26:42',
                'dt_modified' => '2021-05-29 13:26:42',
                'bl_active' => 1,
            ],
        ];
        parent::init();
    }
}
