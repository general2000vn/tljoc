<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AbcCampaign Entity
 *
 * @property int $id
 * @property string $period
 * @property int $initiator_id
 * @property \Cake\I18n\FrozenDate $deadline
 * @property int $abc_status_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Initiator $initiator
 * @property \App\Model\Entity\AbcStatus $abc_status
 * @property \App\Model\Entity\AbcForm[] $abc_forms
 * @property \App\Model\Entity\AbcQuestion[] $abc_questions
 */
class AbcCampaign extends Entity
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
        'period' => true,
        'initiator_id' => true,
        'deadline' => true,
        'abc_status_id' => true,
        'abc_questions' => true,
        'abc_forms' => true,
        'created' => true,
        'modified' => true,
        'initiator' => true,
        'abc_status' => true,
    ];
}
