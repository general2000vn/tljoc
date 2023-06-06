<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OilField Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \App\Model\Entity\DashboardPrdDay[] $dashboard_prd_days
 * @property \App\Model\Entity\DashboardPrdYear[] $dashboard_prd_years
 */
class OilField extends Entity
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
        'name' => true,
        'dashboard_prd_days' => true,
        'dashboard_prd_years' => true,
    ];
}
