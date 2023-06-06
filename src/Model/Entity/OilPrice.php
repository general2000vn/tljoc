<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OilPrice Entity
 *
 * @property int $id
 * @property float|null $brent
 * @property float|null $wti
 * @property float|null $usd
 * @property \Cake\I18n\FrozenDate $update_date
 * @property \Cake\I18n\Time $update_time
 * @property \Cake\I18n\FrozenTime $update_timestamp
 */
class OilPrice extends Entity
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
        'brent' => true,
        'wti' => true,
        'usd' => true,
        'update_date' => true,
        'update_time' => true,
        'update_timestamp' => true,
    ];
}
