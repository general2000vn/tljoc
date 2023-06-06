<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Partner Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $initial
 * @property string|null $representative
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $address
 * @property int|null $modifier_id
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\DocIncoming[] $doc_incomings
 * @property \App\Model\Entity\DocOutgoing[] $doc_outgoings
 */
class Partner extends Entity
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
        'name2' => true,
        'entity_code' => true,
        'tax_code' => true,
        'contact' => true,
        'email' => true,
        'phone' => true,
        'fax' => true,
        'address1' => true,
        'address2' => true,
        'address3' => true,
        'account_no' => true,
        'account_name' => true,
        'bank_name' => true,
        'bank_branch' => true,
        'bank_code' => true,
        'modifier_id' => true,
        'modified' => true,
        'created' => true,
        'doc_incomings' => true,
        'doc_outgoings' => true,
        'order_reqs' => true,
    ];
}
