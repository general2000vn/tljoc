<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HseStat Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $from_date
 * @property int $lost_time
 * @property int $med_treat_case
 * @property int $first_aid_case
 * @property int $fire_explosion
 * @property int $near_miss
 * @property int $obs_card
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class HseStat extends Entity
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
        'from_date' => true,
        'lost_time' => true,
        'med_treat_case' => true,
        'first_aid_case' => true,
        'fire_explosion' => true,
        'near_miss' => true,
        'obs_card' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
