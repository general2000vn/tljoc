<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrSupplier Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $contact
 * @property int $order_req_id
 *
 * @property \App\Model\Entity\OrderReq $order_req
 */
class OrSupplier extends Entity
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
        'contact' => true,
        'rep' => true,
        'order_req_id' => true,
        'order_req' => true,
    ];
}
