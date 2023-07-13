<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DocIncoming Entity
 *
 * @property int $id
 * @property string $subject
 * @property string $name
 * @property \Cake\I18n\FrozenDate $reg_date
 * @property int $reg_num
 * @property string $reg_text
 * @property string|null $ref_text
 * @property int $doc_company_id
 * @property int $partner_id
 * @property string|null $contract_num
 * @property int $inputter_id
 * @property \Cake\I18n\FrozenDate|null $reciving_date
 * @property int $doc_method_id
 * @property int $doc_status_id
 * @property int $doc_type_id
 * @property int $doc_sec_level_id
 * @property int|null $related_doc_id
 * @property string $remark
 * @property int $modifier_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $is_reserved
 *
 * @property \App\Model\Entity\DocCompany $doc_company
 * @property \App\Model\Entity\Department[] $departments
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Partner $partner
 * @property \App\Model\Entity\User $inputter
 * @property \App\Model\Entity\User $modifier
 * @property \App\Model\Entity\DocMethod $doc_method
 * @property \App\Model\Entity\DocStatus $doc_status
 * @property \App\Model\Entity\DocType $doc_type
 * @property \App\Model\Entity\DocSecLevel $doc_sec_level
 * @property \App\Model\Entity\RelatedDoc $related_doc
 */
class DocIncoming extends Entity
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
        'subject' => true,
        'reg_date' => true,
        'reg_num' => true,
        'reg_text' => true,
        'ref_text' => true,
        //'doc_company_id' => true,'doc_company' => true,
        'partner_id' => true,'partner' => true,
        'contract_num' => true,
        'inputter_id' => true,'inputer' => true,
        'receiving_date' => true,
        'doc_method_id' => true,'doc_method' => true,
        'doc_status_id' => true,'doc_status' => true,
        'doc_type_id' => true,'doc_type' => true,
        'remark' => true,
        'modifier_id' => true,'modifier' => true,
        'created' => true,
        'modified' => true,        
        'doc_sec_level_id' => true, 'doc_sec_level' => true,
        'departments' => true,
        'doc_file' => true,
        'doc_outgoing_id' => true, 'doc_outgoing' => true,
        'is_reserved' => true,
        'users' => true,
    ];

    protected function _getName()
    {
        return $this->reg_text . ' - ' . $this->subject;
    }

    protected $_virtual = ['name'];
}
