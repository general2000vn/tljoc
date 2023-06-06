<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DashboardPrdDay Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $stat_date
 * @property int $oil_rate_cnv
 * @property int $oil_rate_tgt
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\OilField $oil_field
 */
class DashboardPrdDay extends Entity
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
        'stat_date' => true,
        'oil_rate_cnv' => true,
        'oil_rate_tgt' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'oil_field' => true,
    ];
}
