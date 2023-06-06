<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DocOutgoing Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $reg_date
 * @property string $subject
 * @property int $doc_type_id
 * @property int $department_id
 * @property string $reg_text
 * @property int $partner_id
 * @property \Cake\I18n\FrozenDate|null $issued_date
 * @property int $originator_id
 * @property string|null $contract_no
 * @property string|null $others
 * @property int $inputter_id
 * @property int $doc_category_id
 * @property int $doc_method_id
 * @property int $doc_sec_level_id
 * @property int $doc_status_id
 * @property int $reg_num
 * @property int $doc_incoming_id
 * @property bool $is_reserved
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\DocType $doc_type
 * @property \App\Model\Entity\DocInDept $department
 * @property \App\Model\Entity\Partner[] $partners
 * @property \App\Model\Entity\Originator $originator
 * @property \App\Model\Entity\Inputter $inputter
 * @property \App\Model\Entity\DocCategory $doc_category
 * @property \App\Model\Entity\DocMethod $doc_method
 * @property \App\Model\Entity\DocSecLevel $doc_sec_level
 * @property \App\Model\Entity\DocStatus $doc_status
 * @property \App\Model\Entity\DocIncoming $doc_incoming
 */
class DocOutgoing extends Entity
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
        'subject' => true,
        'doc_type_id' => true,

        'department_id' => true,'department' => true,
        'reg_text' => true,
        'reg_num' => true,

        'issued_date' => true,
        'originator_id' => true,'originator' => true,
        
        'contract_no' => true,
        'inputter_id' => true,
        //'doc_category_id' => true,
        'doc_method_id' => true,
        'doc_sec_level_id' => true,
        'doc_status_id' => true,
        'doc_type' => true,
        
        'is_reserved' => true,
        'others' => true,
        'partners' => true,
        'doc_incoming_id' => true,
        'inputter' => true,
        'doc_category' => true,
        'doc_method' => true,
        'doc_sec_level' => true,
        'doc_status' => true,
        'doc_file' => true,

        'remark' => true,
    ];

    protected function _getName()
    {
        return $this->reg_text . ' - ' . $this->subject;
    }

    protected $_virtual = ['name'];
}
