<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RunnerRacesFixture
 */
class RunnerRacesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_runner' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_racing_event' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dt_created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'dt_modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'bl_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'racing_event_key' => ['type' => 'index', 'columns' => ['id_racing_event'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'id_runner' => ['type' => 'unique', 'columns' => ['id_runner', 'id_racing_event'], 'length' => []],
            'runner_races_ibfk_2' => ['type' => 'foreign', 'columns' => ['id_racing_event'], 'references' => ['racing_events', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'runner_races_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_runner'], 'references' => ['runners', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'id_runner' => 1,
                'id_racing_event' => 1,
                'dt_created' => '2021-05-29 13:26:56',
                'dt_modified' => '2021-05-29 13:26:56',
                'bl_active' => 1,
            ],
        ];
        parent::init();
    }
}
