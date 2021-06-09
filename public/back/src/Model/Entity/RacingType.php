<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RacingType Entity
 *
 * @property int $id
 * @property string $ds_type
 * @property \Cake\I18n\FrozenTime|null $dt_created
 * @property \Cake\I18n\FrozenTime|null $dt_modified
 * @property bool $bl_active
 */
class RacingType extends Entity
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
        'ds_type' => true,
        'dt_created' => true,
        'dt_modified' => true,
        'bl_active' => true,
    ];
}
