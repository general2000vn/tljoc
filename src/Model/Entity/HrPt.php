<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HrPt Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $issue_date
 * @property \Cake\I18n\FrozenDate $last_date
 * @property \Cake\I18n\FrozenDate $o_last_date
 * @property int $staff_id
 * @property string|null $position
 * @property string $department
 * @property int $supervisor_id
 * @property float $work_year
 * @property int $hr_p_status_id
 *
 * @property \App\Model\Entity\Staff $staff
 * @property \App\Model\Entity\Creator $creator
 * @property \App\Model\Entity\Supervisor $supervisor
 * @property \App\Model\Entity\HrPStatus $hr_p_status
 * @property \App\Model\Entity\HrPtTask[] $hr_pt_tasks
 */
class HrPt extends Entity
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
        'issued_date' => true,
        'last_date' => true,
        'o_last_date' => true,
        'staff_id' => true,
        'position' => true,
        'emp_type' => true,
        'department' => true,
        'supervisor_id' => true,
        'work_year' => true,
        'hr_p_status_id' => true,
        'staff' => true,
        'creator_id' => true, 'creator' => true,
        'supervisor' => true,
        'hr_p_status' => true,
        'hr_pt_tasks' => true,
        'name' => true,
    ];


}
