<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Department Entity
 *
 * @property int $id
 * @property string $name
 * @property string $init
 * @property int|null $user_id
 * @property int|null $dlm_id
 * @property int|null $parent_id
 *
 * @property \App\Model\Entity\User $manager
 * @property \App\Model\Entity\User $dlm
 * @property \App\Model\Entity\ParentDepartment $parent_department
 * @property \App\Model\Entity\ChildDepartment[] $child_departments
 */
class Department extends Entity
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
        'init' => true,
        'user_id' => true, 'manager' => true,
        'dlm_id' => true, 'dlm' => true,
        'parent_id' => true,
        'users' => true, 
        'parent_department' => true,
        'child_departments' => true,
        'doc_incomings' => true,
        'is_deleted' => true,
    ];
}
