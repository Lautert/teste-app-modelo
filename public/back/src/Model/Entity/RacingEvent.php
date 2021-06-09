<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RacingEvent Entity
 *
 * @property int $id
 * @property int $id_racing_types
 * @property \Cake\I18n\FrozenDate $dt_schedule
 * @property \Cake\I18n\FrozenTime|null $dt_created
 * @property \Cake\I18n\FrozenTime|null $dt_modified
 * @property bool $bl_active
 */
class RacingEvent extends Entity
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
        'id_racing_types' => true,
        'dt_schedule' => true,
        'dt_created' => true,
        'dt_modified' => true,
        'bl_active' => true,
    ];
}
