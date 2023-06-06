<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DocInternal Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $reg_date
 * @property int $doc_internal_type_id
 * @property int $doc_status_id
 * @property int $doc_company_id
 * @property int $department_id
 * @property string $reg_text
 * @property int $reg_num
 * @property \Cake\I18n\FrozenDate|null $issued_date
 * @property int $originator_id
 * @property int $inputter_id
 * @property int $modifier_id
 * @property string|null $doc_file
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $subject
 * @property string $name
 * @property string|null $remark
 * @property bool $is_reserved
 *
 * @property \App\Model\Entity\DocInternalType $doc_internal_type
 * @property \App\Model\Entity\DocStatus $doc_status
 * @property \App\Model\Entity\DocCompany $doc_company
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Originator $originator
 * @property \App\Model\Entity\Inputter $inputter
 * @property \App\Model\Entity\Modifier $modifier
 */
class DocInternal extends Entity
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
        'reg_date' => true,
        'doc_internal_type_id' => true,'doc_internal_type' => true,
        'doc_status_id' => true,'doc_status' => true,
        'doc_sec_level_id' => true, 'doc_sec_level' => true,
        
        'department_id' => true,'department' => true,
        'reg_text' => true,
        'reg_num' => true,
        'issued_date' => true,
        'originator_id' => true,'originator' => true,
        'inputter_id' => true,'inputter' => true,
        'modifier_id' => true,'modifier' => true,
        'doc_file' => true,
        'created' => true,
        'modified' => true,
        'subject' => true,
        'remark' => true,
        'is_reserved' => true,

    ];

    protected function _getName()
    {
        return $this->reg_text . ' - ' . $this->subject;
    }

    protected $_virtual = ['name'];
}
