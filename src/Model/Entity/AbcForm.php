<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AbcForm Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $handler_id
 * @property int $last_handler_id
 * @property int $abc_campaign_id
 * @property bool|null $is_abnormal
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $submit_date
 * @property \Cake\I18n\FrozenTime $remind_date
 * @property \Cake\I18n\FrozenTime $ack_date
 * @property bool $is_vn
 * @property int $abc_form_status_id
 * @property string|null $justification
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\User $handler
 * @property \App\Model\Entity\User $last_handler
 * @property \App\Model\Entity\AbcCampaign $abc_campaign
 * @property \App\Model\Entity\AbcStatus $abc_form_status
 * @property \App\Model\Entity\AbcAnswer[] $abc_answers
 */
class AbcForm extends Entity
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
        'handler_id' => true, 'handler' => true,
        'last_handler_id' => true, 'last_handler' => true,
        'abc_campaign_id' => true,
        'is_abnormal' => true,
        'modified' => true,
        'is_vn' => true,
        'abc_form_status_id' => true,
        'justification' => true,
        'user' => true,
        'abc_campaign' => true,
        'abc_form_status' => true,
        'abc_answers' => true,
        'remind_date' => true,
        'submit_date' => true,
        'ack_date' => true,
        'feedback' => true,
    ];
}
