<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RunnerRaceResult Entity
 *
 * @property int $id
 * @property int $id_runner_race
 * @property \Cake\I18n\FrozenTime $tm_start_time
 * @property \Cake\I18n\FrozenTime $tm_end_time
 * @property \Cake\I18n\FrozenTime|null $dt_created
 * @property \Cake\I18n\FrozenTime|null $dt_modified
 */
class RunnerRaceResult extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id_runner_race' => true,
        'tm_start_time' => true,
        'tm_end_time' => true,
        'dt_created' => true,
        'dt_modified' => true,
    ];
}
