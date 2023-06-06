<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timesheet Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\FrozenDate|null $end_date
 * @property \Cake\I18n\Time|null $end_time
 * @property int|null $total_hour
 * @property string|null $remark
 *
 * @property \App\Model\Entity\User $user
 */
class Timesheet extends Entity
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
        'user_id' => true,
        'start_date' => true,
        'start_time' => true,
        'end_date' => true,
        'end_time' => true,
        'total_hour' => true,
        'remark' => true,
        'user' => true,
        'vaccination' => true,
        'vaccination_id' => true,
        'health_id' => true,
        'health' => true,
        'addr_city' => true,
        'addr_district' => true,
        'addr_ward' => true,
        'addr_detail' => true,
        'ts_location_id' => true,
        'ts_location' => true,
    ];
}
