<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HrPtTask Entity
 *
 * @property int $id
 * @property string $description
 * @property string $remark
 * @property int $hr_p_task_status_id
 * @property int $hr_task_category_id
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $complete_time
 * @property int|null $modifier_id
 * @property int $hr_pt_id
 * @property \Cake\I18n\FrozenDate|null $reminding_date
 *
 * @property \App\Model\Entity\HrPTaskStatus $hr_p_task_status
 * @property \App\Model\Entity\HrTaskCategory $hr_task_category
 * @property \App\Model\Entity\Modifier $modifier
 * @property \App\Model\Entity\HrPt $hr_pt
 * @property \App\Model\Entity\User[] $users
 */
class HrPtTask extends Entity
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
        'description' => true,
        'remark' => true,
        'hr_p_task_status_id' => true,'hr_p_task_status' => true,
        'modified' => true,
        'complete_time' => true,
        'modifier_id' => true,
        'hr_pt_id' => true,
        'reminding_date' => true,
        'hr_task_category_id' => true, 'hr_task_category' => true,
        'modifier' => true,
        'hr_pt' => true,
        'users' => true,
    ];
}
