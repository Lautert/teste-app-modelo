<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RunnersFixture
 */
class RunnersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'ds_name' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'ds_document' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'dt_birth' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'dt_created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'dt_modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'bl_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'ds_document' => ['type' => 'unique', 'columns' => ['ds_document'], 'length' => []],
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
                'ds_name' => 'Lorem ipsum dolor sit amet',
                'ds_document' => 'Lorem ipsum dolor sit amet',
                'dt_birth' => '2021-05-29',
                'dt_created' => '2021-05-29 13:23:30',
                'dt_modified' => '2021-05-29 13:23:30',
                'bl_active' => 1,
            ],
        ];
        parent::init();
    }
}
