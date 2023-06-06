<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AppComment Entity
 *
 * @property int $id
 * @property int|null $ac_module_id
 * @property string|null $page
 * @property string $brief
 * @property int $user_id
 * @property string|null $description
 * @property int|null $ac_type_id
 * @property int|null $ac_result_id
 * @property int|null $ac_status_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\AcType $ac_type
 * @property \App\Model\Entity\AcResult $ac_result
 * @property \App\Model\Entity\AcStatus $ac_status
 * @property \App\Model\Entity\AcStatus $ac_module
 */
class AppComment extends Entity
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
        'module' => true,
        'page' => true,
        'brief' => true,
        'user_id' => true,
        'description' => true,
        'ac_type_id' => true,
        'ac_result_id' => true,
        'ac_module_id' => true,
        'ac_status_id' => true,
        'user' => true,
        'ac_type' => true,
        'ac_result' => true,
        'ac_status' => true,
        'ac_module' => true,
    ];
}
