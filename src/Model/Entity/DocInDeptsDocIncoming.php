<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DocInDeptsDocIncoming Entity
 *
 * @property int $id
 * @property int $doc_in_dept_id
 * @property int $doc_incoming_id
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\DocIncoming $doc_incoming
 */
class DocInDeptsDocIncoming extends Entity
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
        'doc_in_dept_id' => true,
        'doc_incoming_id' => true,
        'department' => true,
        'doc_incoming' => true,
    ];
}
