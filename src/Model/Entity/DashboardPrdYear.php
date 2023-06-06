<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DashboardPrdYear Entity
 *
 * @property int $id
 * @property int $target_year
 * @property int $cnv_target
 * @property int $tgt_target
 */
class DashboardPrdYear extends Entity
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
        'target_year' => true,
        'cnv_target' => true,
        'tgt_target' => true,
    ];
}
