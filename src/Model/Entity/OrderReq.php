<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\I18n\Number;
use Cake\ORM\Entity;

/**
 * OrderReq Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $req_num
 * @property int $or_type_id
 * @property \Cake\I18n\FrozenDate|null $submit_date
 * @property int $doc_company_id
 * @property int $department_id
 * @property \Cake\I18n\FrozenDate|null $required_date
 * @property string|null $contract_num
 * @property string|null $budget_code
 * @property int|null $budget_available
 * @property int|null $budget_remain
 * @property int|null $cp_method_id

 * @property int $currency_id
 * @property int $originator_id
 * @property int $handler_id
 * @property string|null $intended_use
 * @property string|null $justification
 * @property string|null $fin_comment
 * @property string|null $dept_comment
 * @property string|null $group_comment
 * @property int $deli_address_id
 * @property int|null $single_source_id
 * @property int|null $group_leader_id
 * @property \Cake\I18n\FrozenTime|null $group_approve_time
 * @property int|null $dept_leader_id
 * @property \Cake\I18n\FrozenTime|null $dept_approve_time
 * @property \Cake\I18n\FrozenTime|null $fin_approve_time
 * @property int|null $fin_verifier_id
 * @property int $or_status_id
 * @property int|null $est_total
 * @property int|null $exch_rate
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\DocCompany $doc_company
 * @property \App\Model\Entity\Currency $currency
 * @property \App\Model\Entity\User $originator
 * @property \App\Model\Entity\User $handler
 * @property \App\Model\Entity\DeliAddress $deli_address
 * @property \App\Model\Entity\Partner $single_source
 * @property \App\Model\Entity\CpMethod $cp_method
 * @property \App\Model\Entity\User $group_leader
 * @property \App\Model\Entity\User $dept_leader
 * @property \App\Model\Entity\User $fin_leader
 * @property \App\Model\Entity\OrStatus $or_status
 * @property \App\Model\Entity\OrType $or_type
 * @property \App\Model\Entity\OrItem[] $or_items
 * @property \App\Model\Entity\Partner[] $suppliers
 * @property \App\Model\Entity\OrUploads[] $or_uploads
 * @property \App\Model\Entity\OrSuppliers[] $or_suppliers
 */
class OrderReq extends Entity
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
        'req_num' => true,
        'or_type_id' => true,
        'submit_date' => true,
        'doc_company_id' => true,
        'department_id' => true,
        'required_date' => true,
        'contract_num' => true,
        'cp_method_id' => true, 'cp_method' => true,
        'budget_code' => true,
        'budget_available' => true,
        'budget_remain' => true,
        'currency_id' => true,
        'originator_id' => true, 'originator' => true,
        'handler_id' => true, 'handler' => true,
        'intended_use' => true,
        'justification' => true,
        'deli_address_id' => true,
        'single_source_id' => true,
        'others' => true,
        'group_leader_id' => true,
        'group_approve_time' => true,
        'dept_leader_id' => true,
        'dept_approve_time' => true,
        'fin_approve_time' => true,
        'fin_verifier_id' => true,
        'or_status_id' => true,
        'est_total' => true,
        'exch_rate' => true,
        'modified' => true,
        'created' => true,
        'department' => true,
        'doc_company' => true,
        'currency' => true,
        
        'deli_address' => true,
        'single_source' => true,
        'group_leader' => true,
        'dept_leader' => true,
        'fin_leader' => true,
        'or_status' => true,
        'or_type' => true,
        'or_items' => true,
        'or_suppliers' => true,
        'or_uploads' => true,

        'group_comment' => true,
        'dept_comment' => true,
        'fin_comment' => true,
    ];


}
